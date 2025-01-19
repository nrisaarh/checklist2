@extends('layouts.app')

@section('title', 'Checklist Management')
@section('header-title', 'Checklist Panel Listrik Electrian GA')

@section('content')
    {{-- Form Tambah Checklist --}}
    @include('checklists.components.checklist-form')

    {{-- Tabel Daftar Checklist --}}
    @include('checklists.components.checklist-table')

    {{-- Modals --}}
    @include('checklists.modals.add-year')
    @include('checklists.modals.add-pic')
    @include('checklists.modals.destroy-pic')
@endsection

@push('scripts')
    <script>
        // Tambahkan semua script untuk modal dan fitur lainnya di sini
    </script>
@endpush
