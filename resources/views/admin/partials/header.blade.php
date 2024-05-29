<header>

    <nav class="navbar bg-dark navbar-dark">
        <div class="container-fluid">
            <a href="{{ route('home') }}" target="_blank" class="navbar-brand fs-2 mx-3">Portfolio</a>
            <div class="d-flex">
                <form action="{{ route('admin.projects.index') }}" method="GET"
                    class="d-flex me-3 d-flex align-items-center" role="search">
                    <input name="toSearch" class="form-control me-2 h-75" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
                </form>
                <div class="me-3">
                    <p class="text-white">{{ Auth::user()->name }}</p>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"><i
                            class="fa-solid fa-right-from-bracket"></i></button>
                </form>

            </div>


            {{-- <button>esci</button> --}}
        </div>
    </nav>

</header>
