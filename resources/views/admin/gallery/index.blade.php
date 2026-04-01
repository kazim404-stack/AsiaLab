@extends('admin.layouts.admin_master')
@section('content')
    @include('admin.gallery.create')
    <di class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Galleries
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-gallery"><i
                            class="fa fa-plus font fs-2">&nbsp;</i>Create</button>
                </div>
                <div class="card-body">
                    <table>
                        <tbody class="table-responsive">
                            <div class="row">
                                @if (!empty($galleries) && $galleries->count() > 0)
                                    @foreach ($galleries as $gallery)
                                        <div class="col-md-3 text-center">
                                            <div class="slider-image position-relative">
                                                <img class="rounded-2 mb-5" src="{{ asset($gallery->image) }}"
                                                    alt="slider-image-{{ $gallery->id }}" width="200">

                                                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <p class="position-absolute text-light badge bg-info"
                                                        style="top: 5px; right: 55px">{{ $gallery->type }}</p>
                                                    <button type="submit" class="position-absolute"
                                                        onclick="return confirm('Are you sure?')"
                                                        style="left: 60px; top: 3px; border: none;">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>

                                                {{-- نمایش state از جدول contacts --}}
                                                <p class="position-absolute text-black fw-bolder"
                                                    style="top: 0; right:60px;">
                                                    @if ($gallery->contact)
                                                        {{-- اگر state چندزبانه است --}}

                                                        {{ $gallery->contact->getTranslation('state', app()->getLocale()) }}
                                                    @else
                                                        No state
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center">Gallery is empty...</p>
                                @endif
                            </div>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </di>
@endsection
