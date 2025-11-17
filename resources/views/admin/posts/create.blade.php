@extends('backend.layouts.app')
@section('title') Create Event @endsection

@section('content')
@section('content-header') Create Event @endsection
@section('card-title') Add Event @endsection

@section('main-content')
<!-- form start -->
<form method="POST" action="#">
    @csrf
    <div class="card-body">

        {{-- Event Title --}}
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text"
                   name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title"
                   placeholder="Event Title"
                   value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Event Date --}}
        <div class="form-group">
            <label for="date">Event Date</label>
            <input type="date"
                   name="date"
                   class="form-control @error('date') is-invalid @enderror"
                   id="date"
                   value="{{ old('date') }}">
            @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Location --}}
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text"
                   name="location"
                   class="form-control @error('location') is-invalid @enderror"
                   id="location"
                   placeholder="Location"
                   value="{{ old('location') }}">
            @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Event Category --}}
        <div class="form-group">
            <label for="category">Event Category</label>
            <select class="custom-select form-control-border @error('category') is-invalid @enderror"
                    id="category"
                    name="category">
                <option value="online" {{ old('category') == 'online' ? 'selected' : '' }}>Online</option>
                <option value="offline" {{ old('category') == 'offline' ? 'selected' : '' }}>Offline</option>
            </select>
            @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description"
                      class="form-control @error('description') is-invalid @enderror"
                      id="description"
                      placeholder="Event Description"
                      style="min-height:150px;">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Create Event</button>
    </div>
</form>
@endsection
@endsection
