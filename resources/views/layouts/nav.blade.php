<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
            <a href="{{ route('index') }}">
                <div style="width: 120px; height: auto;">
                    <img src="{{ Vite::asset('resources/images/logo-no-background.png') }}" alt=""
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </a>
        </a>

        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                {{-- <a href="index.html" class="nav-item nav-link active">Home</a> --}}

                {{-- <a href="about.html" class="nav-item nav-link">About</a> --}}

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Danh mục</a>
                    <div class="dropdown-menu m-0">
                        @foreach ($_CATEGORY ?? [] as $item)
                            <li class="nav-item">
                                <a href="{{ route('category.getRoom', ['slug' => $item->slug, 'category' => $item->id]) }}"
                                    class="dropdown-item" title="{{ $item->name }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </div>
                </div>

                <a href="contact.html" class="nav-item nav-link">Liên hệ</a>

                @guest
                    <div class="d-flex flex-row align-items-center justify-content-between" style="column-gap: 12px;">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary d-none d-lg-flex">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-primary d-none d-lg-flex">Đăng kí</a>
                    </div>
                @endguest

                {{-- <a href="{{ route('logout') }}" class="btn btn-primary px-3 d-none d-lg-flex">Đăng xuất</a> --}}
            </div>

            @auth
                <div class="d-flex flex-row align-items-center justify-content-between" style="column-gap: 12px;">
                    <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-primary">Thêm tin mới</a>

                    @if (Auth::user()->isAdmin)
                        <a href="{{ route('admins.dashboard') }}" class="btn btn-sm btn-outline-success">Quản trị</a>
                    @endif
                </div>

                <div class="nav-item dropdown-center">
                    <a class="nav-link" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="{{ asset('images/' . Auth::user()->avatar) }}"
                            alt=""style="width: 25px; height: 25px; border-radius: 50%;">
                    </a>

                    <div class="dropdown-menu dropdown-menu-end m-0">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <img src="{{ asset('images/' . Auth::user()->avatar) }}"
                                style="width: 25px; height: 25px; border-radius: 50%; margin-right: 12px;">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-divider"></div>

                        <div class="dropdown-item d-flex flex-column">
                            <span class="">Số dư khả dụng</span>
                            <small
                                class=" text text-success mx-auto">{{ number_format(auth()->user()->account_balance, 0, '', '.') }}
                                vnđ</small>
                        </div>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('rooms.index') }}">Quản lí tin đăng</a>
                        <a class="dropdown-item" href="{{ route('recharge.index') }}">Quản lí nạp tiền</a>
                        <a class="dropdown-item" href="{{ route('payments.history') }}">Lịch sử thanh toán</a>

                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Đăng xuất</a>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </nav>
</div>
