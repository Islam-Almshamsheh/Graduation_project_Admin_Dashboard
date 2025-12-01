@extends('backend.layouts.app')
@section('title') Show Info @endsection
@section("content")
    <section class="content">
    @section('content-header') User Info @endsection
    @section('card-title') Personal Information @endsection
    @section('main-content')
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">User Name</span>
                <span class="info-box-number">
                  {{ $student['full_name'] }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Email</span>
                <span class="info-box-number"> {{ $student['email'] }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-id-badge"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ID</span>
                <span class="info-box-number">{{ $student['uid'] }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Role</span>
                <span class="info-box-number">{{ $student['major'] }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        
        </div>
    </section>
    @endsection
@endsection