@extends('backend.layouts.app')

@section('title') Tag Category @endsection
@section('content')
@section('content-header') Tag Category @endsection
@section('card-title') Tag Info @endsection

@section('main-content')
<section class="content">
  <div class="container-fluid">

    @php
    // Temporary frontend-only tags array
    $tags = [
        ['id' => 1, 'name' => 'Laravel'],
        ['id' => 2, 'name' => 'PHP'],
        ['id' => 3, 'name' => 'Frontend']
    ];
    @endphp

    <!-- Create Tag Form -->
    <form method="POST" action="#">
      @csrf
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add Tag</h3>
        </div>

        <div class="card-body">
          <div class="form-group">
            <label for="name">Tag Name</label>
            <input type="text"
              id="name"
              name="name"
              value="{{ old('name') }}"
              class="form-control gray-input"
              placeholder="Enter tag name">
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-success">Create Tag</button>
        </div>
      </div>
    </form>

    <!-- Display existing tags (frontend only) -->
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">Existing Tags</h3>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Tag Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tags as $tag)
            <tr>
              <td>{{ $tag['id'] }}</td>
              <td>{{ $tag['name'] }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>

<style>
/* Gray inputs like other forms */
input.gray-input {
    background-color: #e9ecef !important;
    color: #000 !important;
    border: 1px solid #ced4da !important;
}

input.gray-input:focus {
    background-color: #dee2e6 !important;
    color: #000 !important;
}
</style>
@endsection
@endsection
