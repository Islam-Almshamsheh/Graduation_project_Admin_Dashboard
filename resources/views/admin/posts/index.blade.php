@extends('backend.layouts.app')

@section('title') All Events @endsection
@section('content')
@section('content-header') All Events @endsection
@section('card-title') Events @endsection

@section('main-content')
@php
// Sample events array (frontend only, no DB)
$events = [
    [
        'id' => 1,
        'title' => 'AI Conference',
        'date' => '2025-12-15',
        'location' => 'Amman',
        'category' => 'online',
        'description' => 'An online conference about AI advancements.'
    ],
    [
        'id' => 2,
        'title' => 'Laravel Workshop',
        'date' => '2025-12-20',
        'location' => 'Irbid',
        'category' => 'offline',
        'description' => 'Hands-on Laravel workshop for beginners.'
    ],
    [
        'id' => 3,
        'title' => 'Flutter Meetup',
        'date' => '2025-12-22',
        'location' => 'Online',
        'category' => 'online',
        'description' => 'A meetup discussing Flutter projects and tips.'
    ],
];
@endphp

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Events</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event['id'] }}</td>
                    <td>{{ $event['title'] }}</td>
                    <td>{{ $event['date'] }}</td>
                    <td>{{ $event['location'] }}</td>
                    <td>{{ ucfirst($event['category']) }}</td>
                    <td>{{ $event['description'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@endsection
