@extends('layouts.admin')

@section('content')
    <h2>Projects</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Project</th>
                <th scope="col">Technology</th>
                <th scope="col">Image</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->technology?->name ?? '-' }}</td>
                    {{-- <td>{{ $project->technology->name }}</td> --}}
                    {{-- <td>{{ $project->image }}</td> --}}
                    <td><img class="img-fluid" src="{{ asset('storage/' . $project->image) }}"
                            style="width: 150px; height: auto;" alt="{{ $project->title }}">
                    </td>
                    <td>{{ $project->creation_date }}</td>
                    <td class="d-flex">

                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning btn-sm me-1"><i
                                class="fa-solid fa-pencil"></i></a>

                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                            onsubmit="return confirm('Sei sicuro di voler eliminare il progetto?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></i></button>
                        </form>

                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>

    <script>
        function submitForm(id) {

            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
    </script>

    {{-- @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif --}}

    {{-- <div class="my-4">
        <form action="{{ route('admin.projects.store') }}" method="POST" class="d-flex">
            @csrf
            <input class="form-control me-2" type="search" placeholder="New Project" name="title">
            <input class="form-control me-2" type="search" placeholder="Description" name="description">
            <input class="form-control me-2" type="search" placeholder="Date" name="creation_date">
            <button class="btn btn-outline-success" type="submit">Send</button>
        </form>

    </div>

    <table class="table crud-table">
        <thead>
            <tr>
                <th scope="col">Projects</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>

                    <form action="{{ route('admin.projects.update', $project) }}" method="POST"
                        id="form-edit-{{ $project->id }}">
                        @csrf
                        @method('PUT')
                        <td>
                            <input type="text" value="{{ $project->title }}" name="title">
                        </td>
                        <td>
                            <input type="text" value="{{ $project->description }}" name="description">
                        </td>
                        <td>
                            <input type="text" value="{{ $project->creation_date }}" name="creation_date">
                        </td>
                    </form>
                    <td class="d-flex">
                        <button class="btn btn-warning btn-sm me-1" onclick="submitForm( {{ $project->id }} )"><i
                                class="fa-solid fa-pencil"></i></button>

                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                            onsubmit="return confirm('Sei sicuro di voler eliminare il progetto?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></i></button>
                        </form>

                    </td>

                </tr>
            @endforeach


        </tbody>
    </table>

    <script>
        function submitForm(id) {

            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
    </script> --}}
    {{ $projects->links('pagination::bootstrap-5') }}
@endsection
