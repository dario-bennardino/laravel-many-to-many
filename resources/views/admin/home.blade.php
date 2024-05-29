@extends('layouts.admin')

@section('content')
    <div class="home-info">
        <h3>Sono presenti {{ $count_projects }} projects</h3>

        <h4>Ultimo progetto:</h4>
        <div>
            <h4>{{ $last_project->title }}</h4>
            <p>{{ $last_project->description }}</p>
        </div>
    </div>
@endsection
