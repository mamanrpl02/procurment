<?php

namespace App\Services;

use App\Models\Workflow;
use App\Models\RTable;
use App\Models\WorkflowExecutionLog;
use Illuminate\Support\Facades\Schema;

class WorkflowEngine
{
    /**
     * Menjalankan workflow aktif untuk suatu tabel transaksi.
     * Mengembalikan attributes yang sudah diproses oleh workflow.
     */
    public function apply(
        string $tableName,
        array $attributes,
        string $eventName,
        ?string $recordId = null
    ): array {
        $table = RTable::where('table_name', $tableName)
            ->where('is_active', true)
            ->first();

        if (!$table) {
            return $attributes;
        }

        $workflows = Workflow::with([
            'workflowGroup',
            'conditions.field',
            'actions.field',
        ])
            ->where('sys_id_r_tables', $table->getKey())
            ->where('workflow_type', 'set_value')
            ->where('is_active', true)
            ->whereHas('workflowGroup', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('sort_order')
            ->get();

        foreach ($workflows as $workflow) {
            $context = $attributes;

            try {
                // Tidak ada kondisi berarti workflow langsung dijalankan.
                $conditionPassed = $this->evaluateConditions(
                    $workflow->conditions,
                    $context
                );

                if (!$conditionPassed) {
                    $this->writeLog(
                        $workflow,
                        $tableName,
                        $recordId,
                        $eventName,
                        'skipped',
                        'Kondisi workflow tidak terpenuhi.',
                        $context
                    );

                    continue;
                }

                $appliedActions = [];

                foreach ($workflow->actions as $action) {
                    $field = $action->field;

                    if (!$field || !$field->is_active || !$field->is_action_allowed) {
                        continue;
                    }

                    $fieldName = $field->field_name;

                    // Pastikan field terdaftar dan benar-benar ada di tabel.
                    if (!Schema::hasColumn($tableName, $fieldName)) {
                        continue;
                    }

                    if ($action->action_type !== 'set_value') {
                        continue;
                    }

                    $attributes[$fieldName] = $action->action_value;
                    $appliedActions[$fieldName] = $action->action_value;
                }

                $this->writeLog(
                    $workflow,
                    $tableName,
                    $recordId,
                    $eventName,
                    'success',
                    'Workflow berhasil dijalankan.',
                    [
                        'conditions_passed' => true,
                        'applied_actions' => $appliedActions,
                        'attributes' => $attributes,
                    ]
                );
            } catch (\Throwable $e) {
                $this->writeLog(
                    $workflow,
                    $tableName,
                    $recordId,
                    $eventName,
                    'failed',
                    $e->getMessage(),
                    $context
                );

                throw $e;
            }
        }

        return $attributes;
    }

    private function evaluateConditions($conditions, array $attributes): bool
    {
        if ($conditions->isEmpty()) {
            return true;
        }

        $result = null;

        foreach ($conditions as $index => $condition) {
            $fieldName = $condition->field?->field_name;

            if (!$fieldName) {
                return false;
            }

            $actualValue = $attributes[$fieldName] ?? null;

            $currentResult = $this->compare(
                $actualValue,
                $condition->operator,
                $condition->condition_value
            );

            if ($result === null) {
                $result = $currentResult;
                continue;
            }

            // Operator pada kondisi berikutnya menjadi penghubung
            // antara kondisi sebelumnya dan kondisi saat ini.
            if (strtoupper($condition->logical_operator) === 'OR') {
                $result = $result || $currentResult;
            } else {
                $result = $result && $currentResult;
            }
        }

        return (bool) $result;
    }

    private function compare($actual, string $operator, $expected): bool
    {
        switch ($operator) {
            case 'equals':
                return (string) $actual === (string) $expected;

            case 'not_equals':
                return (string) $actual !== (string) $expected;

            case 'greater_than':
                return is_numeric($actual)
                    && is_numeric($expected)
                    && $actual > $expected;

            case 'less_than':
                return is_numeric($actual)
                    && is_numeric($expected)
                    && $actual < $expected;

            case 'greater_than_or_equal':
                return is_numeric($actual)
                    && is_numeric($expected)
                    && $actual >= $expected;

            case 'less_than_or_equal':
                return is_numeric($actual)
                    && is_numeric($expected)
                    && $actual <= $expected;

            case 'is_empty':
                return $actual === null || trim((string) $actual) === '';

            case 'is_not_empty':
                return $actual !== null && trim((string) $actual) !== '';

            default:
                return false;
        }
    }

    private function writeLog(
        Workflow $workflow,
        string $tableName,
        ?string $recordId,
        string $eventName,
        string $status,
        string $message,
        array $context
    ): void {
        WorkflowExecutionLog::create([
            'sys_id_r_workflows' => $workflow->getKey(),
            'table_name' => $tableName,
            'record_id' => $recordId,
            'event_name' => $eventName,
            'execution_status' => $status,
            'message' => $message,
            'context' => $context,
        ]);
    }
}
