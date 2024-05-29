@extends('layouts.admin')

@section('content')
    <h1>New Project</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="w-50" action="{{ route('admin.projects.store') }}" method="POST" class="d-flex"
        enctype="multipart/form-data">
        @csrf


        <div class="mb-3">
            <label for="technology" class="form-label">Tecnologia</label>
            <select name="technology_id" class="form-select" aria-label="Default select example">
                <option value="">select technology</option>
                @foreach ($technologies as $technology)
                    <option value="{{ $technology->id }}">
                        {{ $technology->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <div class="btn-group btn-group-sm" role="group">
                @foreach ($types as $type)
                    <input name="types[]" type="checkbox" class="btn-check" id="type_{{ $type->id }}" autocomplete="off"
                        value="{{ $type->id }}" @if (in_array($type->id, old('types', []))) checked @endif>

                    <label class="btn btn-outline-primary" for="type_{{ $type->id }}">{{ $type->name }}</label>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Titolo (*)</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                placeholder="titolo" name="title" value="{{ old('title') }}">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                placeholder="immagine" name="image" value="{{ old('image') }}">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>

        <div class="mb-3">
            <label for="creation_date" class="form-label">Data di creazione</label>
            <input type="date" class="form-control @error('creation_date') is-invalid @enderror" id="creation_date"
                placeholder="descrizione" name="creation_date" value="{{ old('creation_date') }}">
            @error('creation_date')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-success" type="submit">Send</button>
            <button class="btn btn-warning" type="reset">Reset</button>
        </div>
    </form>
@endsection
