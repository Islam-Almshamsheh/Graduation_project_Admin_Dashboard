@extends('backend.layouts.app')
@section('title') Users Management @endsection

@section('content')
@section('content-header') Users Management @endsection
@section('card-title') Students & Admins @endsection

@section('main-content')

{{-- ===================== STUDENTS & ADMINS SUMMARY CARD ===================== --}}
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users"></i> Students & Admins Summary</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Total Students --}}
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-primary">
                            <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Students</span>
                                <span class="info-box-number">{{ count($students) }}</span>
                                <div class="progress"><div class="progress-bar" style="width: 100%"></div></div>
                                <span class="progress-description">All registered students</span>
                            </div>
                        </div>
                    </div>
                    {{-- Total Admins --}}
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-secondary">
                            <span class="info-box-icon"><i class="fas fa-user-shield"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Admins</span>
                                <span class="info-box-number">{{ count($admins) }}</span>
                                <div class="progress"><div class="progress-bar" style="width: 100%"></div></div>
                                <span class="progress-description">All admins (read-only)</span>
                            </div>
                        </div>
                    </div>
                    {{-- You can add more cards here if needed --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===================== STUDENTS TABLE ===================== --}}
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-graduate"></i> Students</h3>
            </div>
            <div class="card-body table-responsive">
                <table id="studentsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Academic Year</th>
                            <th>GPA</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student['uid'] }}</td>
                            <td>{{ $student['full_name'] }}</td>
                            <td>{{ $student['email'] }}</td>
                            <td>{{ $student['academic_year'] }}</td>
                            <td>{{ $student['gpa'] }}</td>
                            <td>
                                <a href="{{ route('students.show', $student['full_name']) }}">
                                    <button class="btn btn-info btn-sm">Show</button>
                                </a>
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="alert('Delete {{$student['full_name']}}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Academic Year</th>
                            <th>GPA</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- ===================== ADMINS TABLE ===================== --}}
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-shield"></i> Admins (Read-only)</h3>
            </div>
            <div class="card-body table-responsive">
                <table id="adminsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin['uid'] }}</td>
                            <td>{{ $admin['full_name'] }}</td>
                            <td>{{ $admin['email'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endsection
