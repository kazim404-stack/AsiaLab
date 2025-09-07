@extends('admin.layouts.admin_master')
@section('content')
    <div class="col-md-8 offset-2 p-4">
        <form class="card" action="{{ route('admin.user.userUpdate',$user->id) }}"  method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Edit user</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Name</label>
                            <div>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter name">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Email</label>
                            <div>
                                <input type="email" class="form-control" name="email" value="{{ $user->email}}" placeholder="Enter email">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
          
             
                   
              

                </div>
            </div>
            <div class="card-footer text-end d-flex justify-content-between align-item-center">
                <a href="{{ route('admin.users.usersList') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i></a>
                <button type="submit" class="btn btn-primary">Update...</button>
            </div>
        </form>
    </div>
@endsection
