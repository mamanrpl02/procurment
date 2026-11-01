
@extends('layout.appLayoutMain')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div>
        <a href="{{ route('workflow-groups.index') }}"
           class="text-sm text-green-700 hover:underline">
            ← Kembali ke Grouping Workflow
        </a>
        <h1 class="mt-3 text-2xl font-bold text-gray-800">
            Edit Grouping Workflow
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            {{ $workflowGroup->group_name }}
        </p>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-7">
        @include('workflow-groups._form')
    </div>
</div>
@endsection
