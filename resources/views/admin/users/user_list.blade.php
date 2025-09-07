@extends('admin.layouts.admin_master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>User list</h3>
            <a href="{{ route('admin.user.createUser') }}" class="btn btn-info btn-md">Add user</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped table-hover table-responsive w-100']) }}
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
