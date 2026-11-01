<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\WorkflowGroupController;
use App\Http\Controllers\RTableController;
use App\Http\Controllers\RFieldController;
use App\Http\Controllers\WorkflowController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('procurment.dashboard');
});


Route::get('/dashboard2', function () {
    return view('dashboard2');
});


Route::get('/supplier/dashboard', function () {
    return view('supplier.dashboard');
});
Route::get('/procurment/showlist', function () {
    return view('procurment.index');
});
Route::get('/procurment/create', function () {
    return view('procurment.create');
});

Route::view('/incidents', 'incident.index');
Route::view('/incidents/create', 'incident.create');

Route::view('/workflow-groups', 'groupingWorkflow.index');
Route::view('/workflow-groups/create', 'groupingWorkflow.create');

Route::resource('purchase-orders', PurchaseOrderController::class);

Route::resource('workflow-groups', WorkflowGroupController::class)
    ->except(['show']);

Route::resource('r-tables', RTableController::class)
    ->except(['show']);

Route::resource('r-fields', RFieldController::class)
    ->except(['show']);

// Workflow Management
Route::get('/workflows/options/{table}', [WorkflowController::class, 'options'])
    ->name('workflows.options');

Route::resource('workflows', WorkflowController::class)
    ->except(['show']);