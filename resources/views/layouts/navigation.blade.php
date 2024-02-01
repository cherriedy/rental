<nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04"
            aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <div style="width: 120px; height: auto;">
                            <img src="{{ Vite::asset('resources/images/logo-no-background.png') }}" alt=""
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </a>
                </li>

                @foreach ($_CATEGORY ?? [] as $item)
                    <li class="nav-item">
                        {{-- <a href="{{ route('public.home.category', ['slug' => $item->slug, 'id' => $item->id]) }}"
                            class="nav-link" title="{{ $item->name }}">{{ $item->name }}</a> --}}

                        <a href="{{ route('category.getRoom', ['slug' => $item->slug, 'category' => $item->id]) }}"
                            class="nav-link" title="{{ $item->name }}">{{ $item->name }}</a>
                    </li>
                @endforeach

            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Đăng nhập</a>
                    </li>

                    <li class="nav-item">
                        <a href="/register" class="nav-link">Tạo tài khoản</a>
                    </li>
                @endguest

                @auth
                    <div class="d-flex flex-row align-items-center justify-content-between" style="column-gap: 12px;">
                        <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-primary">Thêm tin mới</a>

                        @if (Auth::user()->isAdmin)
                            <a href="{{ route('admins.dashboard') }}" class="btn btn-sm btn-outline-success">Quản lý</a>
                        @endif
                    </div>

                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ url('storage/', Auth::user()->avatar) }}"
                                alt=""style="width: 25px; height: 25px; border-radius: 50%;">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <img src="{{ url('storage/', Auth::user()->avatar) }}"
                                    style="width: 25px; height: 25px; border-radius: 50%; margin-right: 12px;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('rooms.index') }}">Quản lí tin đăng</a>
                            <a class="dropdown-item" href="{{ route('recharge.index') }}">Nạp tiền</a>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Đăng xuất</a>
                            </form>
                        </div>
                    </div>
                @endauth
            </ul>

        </div>
    </div>
    </div>
</nav>
