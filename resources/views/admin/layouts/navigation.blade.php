<nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04"
            aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="{{ route('admins.dashboard') }}" class="nav-link">
                        <div style="width: 120px; height: auto;">
                            <img src="{{ Vite::asset('resources/images/logo-no-background.png') }}" alt=""
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </a>

                </li>

            </ul>

            <ul class="navbar-nav">

                <div class="d-flex align-items-center">
                    <a href="{{ route('index') }}" class="btn btn-sm btn-outline-warning">Trang chủ</a>
                </div>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('images/' . Auth::user()->avatar) }}"
                                alt=""style="width: 25px; height: 25px; border-radius: 50%;">
                            {{-- {{ Auth::user()->name }} --}}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <img src="{{ url('storage/', Auth::user()->avatar) }}"
                                    style="width: 25px; height: 25px; border-radius: 50%; margin-right: 12px;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-divider"></div>


                            <a class="dropdown-item" href="/rooms">Quản lí tin đăng</a>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Đăng xuất</a>
                            </form>

                            {{-- <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a> --}}
                        </div>
                    </li>

                @endauth
            </ul>

        </div>
    </div>
    </div>
</nav>
