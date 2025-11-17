@extends('backend.layouts.app')

@section('title') Create Category @endsection

@section('content')
    @section('content-header') Create Category @endsection
    @section('card-title') Category Info @endsection

    @section('main-content')
    <section class="content">
        <div class="container-fluid">
            <!-- Form Card -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                </div>

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Enter category name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endsection
@endsection
