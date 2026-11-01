@extends('layout.appLayoutMain')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div>
        <a href="{{ route('r-fields.index') }}" class="text-sm text-green-700">← Kembali</a>
        <h1 class="mt-3 text-2xl font-bold text-gray-800">Tambah Master Field</h1>
        <p class="mt-1 text-sm text-gray-500">Daftarkan field yang boleh digunakan dalam workflow.</p>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-7">
        @include('r-fields._form')
    </div>
</div>
@endsection
