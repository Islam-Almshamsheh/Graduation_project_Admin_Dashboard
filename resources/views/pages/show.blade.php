@extends('layouts.app')

@section('title') {{ $post->title }} | UniGuide @endsection

@section('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
<section class="container mx-auto py-10 px-4">
    <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-md overflow-hidden">

        <div class="md:w-1/2 w-full h-80 md:h-auto">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                class="w-full h-full object-cover object-center">
        </div>

        <div class="md:w-1/2 w-full p-6 flex flex-col justify-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>

            <div class="text-gray-700 text-base leading-relaxed mb-6">
                {!! nl2br(e($post->post)) !!}
            </div>

            @if($post->category)
                <div class="mb-2 text-sm">
                    <strong class="text-gray-600">Category:</strong>
                    <span class="text-indigo-600">{{ $post->category->name }}</span>
                </div>
            @endif

            @if($post->tags->count())
                <div class="mb-2 text-sm">
                    <strong class="text-gray-600">Tags:</strong>
                        @foreach($post->tags as $tag)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 text-xs rounded-full">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                </div>
            @endif

            <div class="text-sm text-gray-500 mb-4">
                <span>By {{ $post->user->name }}</span> |
                <span>{{ $post->created_at->format('F j, Y') }}</span>
            </div>
        </div>
    </div>
</section>
@endsection
