@extends('admin.layouts.admin_master')
@section('content')
    @include('admin.category.create')
    @include('admin.category.edit')
    <di class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Categories
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#create-category"
                        id="get-category" data-get-category-url="{{ route('admin.get.categories.getCategory') }}">
                        <i class="fas fa-plus me-1"></i> Create
                    </button>


                </div>
                <div class="card-body">
                    <table>
                        <tbody class="table-responsive">

                            {{ $dataTable->table(['class' => 'table table-striped table-hover table-responsive w-100']) }}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </di>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
