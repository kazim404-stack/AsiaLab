@extends('admin.layouts.admin_master')
@section('content')
    @include('admin.photo.create')
    <di class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Photos
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#create-photo"><i class="fa fa-plus font fs-2">&nbsp;</i>Create</button>


                </div>
                <div class="card-body">
                    <table>
                        <tbody class="table-responsive">
                            <div class="row">
                                @foreach ($photos as $photo)
                                    <div class="col-md-3 text-center">
                                        <div class="slider-image position-relative">
                                            <img class="rounded-2 mb-5" src="{{ asset($photo->image) }}"
                                                alt="slider-image-{{ $photo->id }}" width="200">

                                            <form
                                                action="{{ route('admin.photos.destroy',$photo->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <p class="position-absolute text-light badge bg-info" style="top: 5px;right: 55px">{{ $photo->type }}</p>
                                                <button type="submit" class="position-absolute"
                                                    onclick="return confirm('Are you sure?')"
                                                    style="left: 60px; top: 3px; border: none;">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>


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
