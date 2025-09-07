@extends('admin.layouts.admin_master')
@section('content')
<div class="page-wrapper">
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Change Profile
          </h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="card">
        <div class="row g-0">
          <form action="{{ route('admin.profile.profileChange') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-12 col-md-9 d-flex flex-column">
              <div class="card-body">
                <h2 class="mb-4">My Account</h2>
                <h3 class="card-title">Profile Details</h3>
                <div class="row align-items-center">
                  <div class="col-auto"><span class="avatar avatar-xl"
                     style="background-image: @if(!Auth::user()->image) url({{ asset('backend/assets/images/no-image.jpg') }}) @else url({{ asset(Auth::user()->image) }})   @endif" ></span>
                  </div>
{{--
                  <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                      Delete avatar
                    </a></div> --}}
                </div>

                <div class="row g-3">
                  <div class="col-md-12">
                    <div class="form-label">Name</div>
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <div class="form-label">Email</div>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <div class="form-label">Image</div>
                    <input type="file" class="form-control" name="image">
                    @error('image')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                  <a href="{{ route('admin.users.usersList') }}" class="btn">
                    Back
                  </a>
                  <button type="submit" class="btn btn-primary">Change Profle</button>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>
@endsection
