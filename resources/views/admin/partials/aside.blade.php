<aside class="bg-dark navbar-dark text-white">
    <nav>
        <ul>
            <li>
                <a href="{{ route('admin.home') }}"><i class="fa-solid fa-house"></i>Home</a>
            </li>
            <li>
                <a href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-folder"></i>Projects</a>
            </li>
            <li>
                <a href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-plus"></i>New Project</a>
            </li>
            <li>
                <a href="{{ route('admin.technologies.index') }}"><i
                        class="fa-solid fa-list-check"></i></i>Technologies</a>
            </li>
            <li>
                <a href="{{ route('admin.types.index') }}"><i class="fa-solid fa-list-check"></i></i>Types</a>
            </li>
        </ul>
    </nav>

</aside>
