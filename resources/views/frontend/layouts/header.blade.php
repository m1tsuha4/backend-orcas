<header id="header" class="header sticky-top">
    <div class="branding">
    <div
        class="container position-relative d-flex align-items-center justify-content-between"
    >
        <a href="{{ route('index.home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('dist_front/assets/img/logo basko-01.png') }}" alt="" />
        </a>

        {{-- <nav id="navmenu" class="navmenu ani">
            <ul class="border">
                <li class="border">
                    <a href="{{ route('index.home') }}" class="{{ $page == 'Home' ? 'active fw-bold' : '' }}"
                        >
                        HOME
                    </a>
                    <div class="ani"></div>
                </li>
                <li class="border">
                    <a href="{{ route('front.store.index') }}" class="{{ $page == 'Store' ? 'active fw-bold' : '' }}">STORE</a>
                </li>
                <li class="border">
                    <a href="{{ route('front.event.index') }}" class="{{ $page == 'Event' ? 'active fw-bold' : '' }}">EVENT&nbsp;&nbsp;&nbsp;</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav> --}}
        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('index.home') }}" class="ani {{ $page == 'Home' ? 'active fw-bold' : '' }}">
                        HOME
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.store.index') }}" class="ani mx-2 {{ $page == 'Store' ? 'active fw-bold' : '' }}">
                        STORE
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.event.index') }}" class="ani {{ $page == 'Event' ? 'active fw-bold' : '' }}">
                        EVENT&nbsp;&nbsp;&nbsp;
                    </a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
    </div>
</header>
