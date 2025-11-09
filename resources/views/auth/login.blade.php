@extends('layouts.app')
@section('title') Login @endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
  <div class="row">
    <div class="col-md-12">
      <div class="login-box mx-auto">
        <div class="card card-outline card-primary" style="border-top-color: #007278d9 !important;">
          <div class="card-header text-center">
            <a href="{{ route('login') }}" class="h1"><b>Log</b>in</a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="input-group mb-3">
                <input type="email" name="email"
                  class="form-control  @error('email') is-invalid @enderror " placeholder="Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="input-group mb-3">
                <input type="password" name="password"
                  class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block" style="background-color: #007278d9 !important; border-color: #007278d9 !important;">Sign In</button>
                </div>
              </div>
            </form>
          </div> <!-- /.card-body -->
        </div> <!-- /.card -->
      </div> <!-- /.login-box -->
    </div>
  </div>
</div>
@endsection
