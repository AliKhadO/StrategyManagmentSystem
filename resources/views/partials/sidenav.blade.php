<div class="col-md-2 p-3 shadow bg-success text-white text-bold rounded-end position-sticky top-0 sidenav">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 text-decoration-none border-bottom">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" width="50" height="50"
            class="d-inline-block align-text-top">
        &nbsp;<span class="fs-5 fw-semibold">GO Strategy</span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                data-bs-target="#home-collapse" aria-expanded="true">
                <i class="fa fa-home"></i>&nbsp; {{ __('nav.home') }}
            </button>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href=" {{ route('home') }}" class="rounded">{{ __('nav.today') }}</a></li>
                    <li><a href=" {{ route('calender') }}" class="rounded">{{ __('nav.calender') }}</a></li>
                    @if (Auth::user()->can(['show reports']))
                        <li><a href=" {{ route('reports') }}" class="rounded">{{ __('nav.reports') }}</a></li>
                    @endif
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                data-bs-target="#dashboard-collapse" aria-expanded="false">
                <i class="fa fa-dashboard"></i>&nbsp; {{ __('nav.dashboard') }}
            </button>
            <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                    @if (Auth::user()->can('show goals'))
                        <li><a href="{{ route('goals.index') }}" class="rounded"> {{ __('nav.show_goals') }}</a></li>
                    @endif
                    @if (Auth::user()->can('add goals'))
                        <li><a href="{{ route('goals.create') }}" class="rounded"> {{ __('nav.add_goals') }}</a></li>
                    @endif
                    @if (Auth::user()->can('show plans'))
                        <li><a href="{{ route('plans.index') }}" class="rounded"> {{ __('nav.show_plans') }}</a></li>
                    @endif
                    @if (Auth::user()->can('add plans'))
                        <li><a href="{{ route('plans.create') }}" class="rounded"> {{ __('nav.add_plan') }}</a></li>
                    @endif
                    @if (Auth::user()->can(['show tasks', 'add tasks']))
                        <li><a href="{{ route('tasks.index') }}" class="rounded"> {{ __('nav.manage_tasks') }}</a>
                        </li>
                    @endif
                    @if (Auth::user()->can(['show tasks']))
                        <li><a href="{{ route('tasks.mytasks') }}" class="rounded"> {{ __('nav.my_tasks') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                data-bs-target="#account-collapse" aria-expanded="false">
                <i class="fa fa-user"></i>&nbsp; {{ __('nav.account') }}
            </button>
            <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('user.edit', Auth::user()->id) }}"
                            class="rounded">{{ __('nav.profile') }}</a></li>
                    <li><a href="{{ route('departments.index') }}" class="rounded">{{ __('Department Management') }}</a>
                    </li>
                    <li><a href="{{ route('user.index') }}" class="rounded">{{ __('Users Management') }}</a>
                    </li>
                    <li><a href="#" class="rounded">{{ __('nav.settings') }}</a></li>

                </ul>
            </div>

        </li>
    </ul>
</div>
