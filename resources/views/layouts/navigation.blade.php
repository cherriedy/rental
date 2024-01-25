{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary"> --}}
<nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="#">Nhà Tốt</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04"
            aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Trang chủ
                        <span class="visually-hidden">(current)</span>
                    </a>

                </li>

                @foreach ($_CATEGORY ?? [] as $item)
                    <li class="nav-item">
                        <a href="{{ route('public.home.category', ['slug' => $item->slug, 'id' => $item->id]) }}"
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ url('storage/', Auth::user()->avatar) }}"
                                alt=""style="width: 25px; height: 25px; border-radius: 50%;">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('profile') }}">Trang cá nhân</a>

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

                    <a href="/rooms/create" class="btn btn-primary">Thêm tin mới</a>
                @endauth
            </ul>

        </div>
    </div>
    </div>
</nav>
