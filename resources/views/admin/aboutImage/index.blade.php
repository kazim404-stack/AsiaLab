@extends('admin.layouts.admin_master')
@section('content')
    @include('admin.aboutImage.create')
    <di class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    About images
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#create-about-image"><i class="fa fa-plus font fs-2">&nbsp;</i>Create</button>


                </div>
                <div class="card-body">
                    <table>
                        <tbody class="table-responsive">
                            <div class="row">
                                @foreach ($aboutImages as $aboutImage)
                                    <div class="col-md-3 text-center">
                                        <div class="slider-image position-relative">
                                            <img class="rounded-2" src="{{ asset($aboutImage->image) }}"
                                                alt="slider-image-{{ $aboutImage->id }}" width="200">

                                            <form
                                                action="{{ route('admin.about.images.destroy', ['about' => $aboutImage->about->id, 'image' => $aboutImage->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
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
