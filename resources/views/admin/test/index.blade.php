@extends('admin.layouts.admin_master')
@section('content')
@include('admin.test.create')
@include('admin.test.edit')
    <di class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Tests
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#create-test" data-href={{ route('admin.get.product.category') }} id="get-product-category"><i class="fa fa-plus font fs-2">&nbsp;</i>Create</button>
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
