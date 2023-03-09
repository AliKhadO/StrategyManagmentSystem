<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        @guest
            <a class="navbar-brand d-flex justify-content-center align-items-center" href="/">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" width="50" height="50"
                    class="d-inline-block align-text-top">
                &nbsp;<span class="fs-5 fw-semibold">GO Strategy</span>
            </a>
        @endguest
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarSupportedContent">
            @guest
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('nav.about_us') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('nav.team') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('nav.contact_us') }}</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}
                    {{-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> --}}
                </ul>
            @else
                <h3>@yield('title')</h3>
            @endguest

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto d-flex justify-content-center align-items-center">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('nav.login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('nav.register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item me-1 ">
                        <a class="nav-link d-flex justify-content-center align-items-center rounded-circle"
                            data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                            aria-controls="offcanvasExample" role="button" style="aspect-ratio : 1 / 1"><i
                                class="fa fa-bell text-success" style="font-size: 1.5rem"></i></a>
                    </li>
                    <li class="nav-item me-1 ">
                        <a class="nav-link d-flex justify-content-center align-items-center rounded-circle"
                            data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                            aria-controls="offcanvasExample" role="button" style="aspect-ratio : 1 / 1">{{ Str::ucfirst(Auth::user()->getRoleNames()['0'])   }}</a>
                    </li>
                    <li class="nav-item dropdown me-1 ">
                        <a id="navbarDropdown"
                            class="nav-link dropdown-toggle d-flex justify-content-center align-items-center rounded-circle shadow "
                            style="aspect-ratio : 1 / 1" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <span> {{ getInitials(Auth::user()->name) }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            @if (app()->getLocale() == 'ar')
                                <a class="dropdown-item" href="{{ route('locale.setting', 'en') }}">
                                    EN
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('locale.setting', 'ar') }}">
                                    ع
                                </a>
                            @endif

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="nav-item">

                </li>
            </ul>
        </div>
    </div>
</nav>
