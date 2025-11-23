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

<!-- ===== Event Cards Section ===== i added this to notpad -->


<!-- ===== Footer Section ===== -->
<footer class="text-center text-white py-4" style="background-color: #007278d9;">
    <p class="mb-1">© {{ date('Y') }} UniGuide. All rights reserved.</p>
    <small>Contact us: info@UniGuide.com</small>
</footer>

@endsection
