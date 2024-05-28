@extends('layouts.admin')

@section('content')
    <h1>Edit Project</h1>


    <form class="w-50" action="{{ route('admin.projects.update', $project) }}" method="POST"
        id="form-edit-{{ $project->id }}">
        @csrf
        @method('PUT')
        {{-- <td>
            <input type="text" value="{{ $project->title }}" name="title">
        </td> --}}

        <div class="mb-3">
            <label for="title" class="form-label">Titolo (*)</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="titolo"
                name="title" value="{{ $project->title }}">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- <td>
            <input type="text" value="{{ $project->description }}" name="description">
        </td> --}}


        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ $project->description }}</textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- <td>
            <input type="date" value="{{ $project->creation_date }}" name="creation_date">
        </td> --}}

        <div class="mb-3">
            <label for="creation_date" class="form-label">Data di creazione</label>
            <input type="date" class="form-control @error('creation_date') is-invalid @enderror" id="creation_date"
                placeholder="descrizione" name="creation_date" value="{{ $project->creation_date }}">
            @error('creation_date')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <td>
            <button class="btn btn-warning btn-sm me-1" onclick="submitForm( {{ $project->id }} )"><i
                    class="fa-solid fa-pencil"></i>
            </button>
        </td>
    </form>
@endsection
