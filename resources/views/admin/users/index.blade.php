@extends('backend.layouts.app')
@section('title') Users Management @endsection

@section('content')
    @section('content-header') Users Management @endsection
    @section('card-title') Students & Admins @endsection

    @section('main-content')

    {{-- ===================== SUMMARY CARDS ===================== --}}
    <h5 class="mt-4 mb-2">Summary</h5>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Students</span>
                    <span class="info-box-number">{{ $users->count() }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">All registered students</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-secondary">
                <span class="info-box-icon"><i class="fas fa-user-shield"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Admins</span>
                    <span class="info-box-number">{{ $admins->count() }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">All admins (read-only)</span>
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
                            <th>Enrollment Year</th>
                            <th>GPA</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->enrollment_year ?? '-' }}</td>
                            <td>{{ $student->gpa ?? '-' }}</td>
                            <td>
                                <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form id="delete-form-{{$student->id}}" style="display:inline;" method="POST" action="{{ route('students.destroy', $student->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmation(event, {{$student->id}})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Enrollment Year</th>
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
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
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
@endsection

@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
function confirmation(ev, id) {
    ev.preventDefault();
    var form = document.getElementById('delete-form-' + id);
    swal({
        title: "Are you sure to delete this?",
        text: "You will not be able to revert this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) form.submit();
    });
}
</script>
@endsection
