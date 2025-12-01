@extends('backend.layouts.app')
@section('title') Edit User @endsection
@section('content')
      @section('content-header') Edit User @endsection
      @section('card-title') User Info @endsection
      @section('main-content')
        <form method="POST" action="{{ route('users.update', $user->id) }}">
          @csrf
          @method('PUT')
          <div class="card-body">
            <!-- Name Field -->
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text"
                     class="form-control @error('name') is-invalid @enderror"
                     id="name"
                     name="name"
                     value="{{ old('name', $user->name) }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email"
                     class="form-control @error('email') is-invalid @enderror"
                     id="email"
                     name="email"
                     value="{{ old('email', $user->email) }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Role Selection -->
            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control @error('role') is-invalid @enderror"
                      id="role"
                      name="role">
                <option value="admin" {{ $user->role == "admin" ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == "user" ? 'selected' : '' }}>User</option>
              </select>
              @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Password Field (without toggling) -->
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password"
                     class="form-control @error('password') is-invalid @enderror"
                     id="password"
                     name="password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password"
                     class="form-control"
                     id="password_confirmation"
                     name="password_confirmation">
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>        
      @endsection
@endsection
