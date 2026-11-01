@extends('layout.appLayoutMain')


@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div>
        <a href="{{ route('r-tables.index') }}" class="text-sm text-green-700">← Kembali</a>
        <h1 class="mt-3 text-2xl font-bold text-gray-800">Edit Master Tabel</h1>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-7">
        @include('r-tables._form')
    </div>
</div>
@endsection
