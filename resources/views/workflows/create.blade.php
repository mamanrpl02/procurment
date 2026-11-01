
@extends('layout.appLayoutMain')

@section('content')
<div class="mx-auto max-w-5xl space-y-6">

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-1 flex items-center gap-2 text-xs text-slate-400">
                <a href="{{ route('workflows.index') }}" class="hover:text-green-700">
                    Workflow Management
                </a>
                <span>/</span>
                <span>Add Workflow</span>
            </div>

            <h1 class="text-xl font-bold text-slate-900">Add Workflow</h1>
            <p class="mt-1 text-sm text-slate-500">
                Buat aturan otomatis untuk transaksi.
            </p>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        @include('workflows._form')
    </div>

</div>
@endsection
