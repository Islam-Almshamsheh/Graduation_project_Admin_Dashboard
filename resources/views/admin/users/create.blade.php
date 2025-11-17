@extends('backend.layouts.app')
@section('title') Create Student @endsection

@section('content')
    @section('content-header') Create Student @endsection
    @section('card-title') Add Student @endsection

    @section('main-content')
    <!-- form start -->
    <form method="POST" >
        @csrf
        <div class="card-body">

            {{-- Name --}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       placeholder="Name"
                       value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       placeholder="Email"
                       value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password"
                       placeholder="Password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       id="password_confirmation"
                       placeholder="Confirm Password">
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- GPA --}}
            <div class="form-group">
                <label for="gpa">GPA</label>
                <input type="text"
                       name="gpa"
                       class="form-control @error('gpa') is-invalid @enderror"
                       id="gpa"
                       placeholder="GPA"
                       value="{{ old('gpa') }}">
                @error('gpa')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Major --}}
            <div class="form-group">
                <label for="major">Major</label>
                <input type="text"
                       name="major"
                       class="form-control @error('major') is-invalid @enderror"
                       id="major"
                       placeholder="Major"
                       value="{{ old('major') }}">
                @error('major')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Enrollment Year --}}
            <div class="form-group">
                <label for="enrollment_year">Enrollment Year</label>
                <input type="number"
                       name="enrollment_year"
                       class="form-control @error('enrollment_year') is-invalid @enderror"
                       id="enrollment_year"
                       placeholder="e.g., 2025"
                       value="{{ old('enrollment_year') }}">
                @error('enrollment_year')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
            <div class="form-group">
                <label for="role">User Role</label>
                <select class="custom-select form-control-border @error('role') is-invalid @enderror"
                        id="role"
                        name="role">
                    <option value="admin" {{ old('role') == "admin" ? 'selected' : '' }}>Admin</option>
                    <option value="student" {{ old('role') == "student" ? 'selected' : '' }}>Student</option>
                </select>
                @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Student</button>
        </div>
    </form>
    @endsection
@endsection
