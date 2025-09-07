@extends('admin.layouts.admin_master')
@section('content')
    @include('admin.testImage.create')
    <di class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    TestImages
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-test-image"><i
                            class="fa fa-plus font fs-2">&nbsp;</i>Create</button>
                </div>
                <div class="card-body">
                    <table>
                        <tbody class="table-responsive">
                            <div class="row">
                                @foreach ($testImages as $testImage)
                                    <div class="col-md-3" id="image-{{ $testImage->id }}">
                                        <div class="machine-image position-relative">
                                            <img src="{{ asset($testImage->image) }}"
                                                alt="machine-image-{{ $testImage->id }}" width="300" class="img-fluid">
                                            <a data-image-id="{{ $testImage->id }}"
                                                href="{{ route('admin.tests.images.destroy', ['test' => $testId, 'image' => $testImage->id]) }}"
                                                id="machine-image-delete"><i
                                                    class="fas fa-trash text-danger position-absolute start-0 top-0 p-2"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </di>
@endsection
