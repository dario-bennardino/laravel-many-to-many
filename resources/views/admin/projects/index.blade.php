@extends('layouts.admin')

@section('content')
    <h2>Projects</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Project</th>
                <th scope="col">Technology</th>
                <th scope="col">Type</th>
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
                    <td>
                        @forelse ($project->types as $type)
                            <span class="badge text-bg-warning">{{ $type->name }}</span>
                        @empty
                            - no type
                        @endforelse


                    </td>

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


    {{ $projects->links('pagination::bootstrap-5') }}
@endsection
