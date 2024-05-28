@extends('layouts.admin')

@section('content')
    <h1>Sono presenti {{ $count_projects }} projects</h1>

    <h2>Ultimo progetto:</h2>
    <div>
        <h3>{{ $last_project->title }}</h3>
        <p>{{ $last_project->description }}</p>
    </div>
@endsection
