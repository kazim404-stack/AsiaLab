@extends('admin.layouts.admin_master')
@section('content')
<div class="col-md-6">
    <form class="card" action="{{ route('admin.change.password') }}" method="post">
        @csrf
      <div class="card-header">
        <h3 class="card-title">Change password</h3>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label required">Current password</label>
          <div>
            <input type="password" name="current_password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Current password">
            @error('current_password')
            <small class="form-hint text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label required">New Password</label>
          <div>
            <input type="password" name="password" class="form-control" placeholder="Password">
            @error('password')
            <small class="form-hint text-danger">{{ $message }}</small> 
            @enderror
           
          </div>
        </div>
        <div class="mb-3">
            <label class="form-label required">Confirm password</label>
            <div>
              <input type="password" class="form-control" placeholder="Password" name="password_confirmation">
              @error('password_confirmation')
              <small class="form-hint text-danger">{{ $message }}</small>
                  
              @enderror
            </div>
          </div>
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Change password</button>
      </div>
    </form>
   
  </div>

@endsection