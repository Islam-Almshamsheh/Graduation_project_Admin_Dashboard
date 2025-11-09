@extends('layouts.app')

@section('title') UniGuide @endsection

@section('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')

<!-- ===== Hero Section ===== -->
<div class="jumbotron text-white mb-0"
     style="background: linear-gradient(to right, rgba(7, 51, 54, 0.85), rgba(41, 129, 130, 0.85),rgba(248, 250, 131, 0.85));
            background-size: cover;
            background-position: center;
            border-radius: 0;
            padding: 100px 2rem 60px 2rem;
            margin-top: 0;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Welcome to UniGuide </h1>
        <p class="lead">“Manage & Organize, Admin Portal.”</p>
        <a href="#posts" class="btn btn-light text-dark fw-bold px-4 py-2 rounded-pill">Explore What's comming soon!</a>
    </div>
</div>

<!-- ===== Event Cards Section ===== -->
<section id="posts" class="py-5" style="background-color: #f9f9fb;">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Event Image"
                    style="height: 220px; object-fit: cover; border: 3px dotted rgba(24, 65, 85, 0.5); box-shadow: 0 4px 10px rgba(0,0,0,0.15);" alt="Event image">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-primary" style="color: #0d4d51d9!important;">{{ $post->title }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($post->content, 100) }}</p>
                            <div class="mt-auto">
                                <p class="mb-1 text-secondary"><i class="fas fa-user"></i> {{ $post->user->name ?? 'Unknown' }}</p>
                                <p class="text-secondary"><i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('M d, Y') }}</p>
                                <a href="{{ route('post.show', $post) }}" class="btn btn-outline-primary btn-sm mt-2">Read More</a>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-top-0">
                            @foreach($post->tags as $tag)
                                <span class="badge bg-navy text-white"style="background-color: #007278d9 !important";>{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== Footer Section ===== -->
<footer class="text-center text-white py-4" style="background-color: #007278d9;">
    <p class="mb-1">© {{ date('Y') }} UniGuide. All rights reserved.</p>
    <small>Contact us: info@UniGuide.com</small>
</footer>

@endsection
