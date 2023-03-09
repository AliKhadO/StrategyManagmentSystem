@include('partials.navbar')
@if (Auth::guest())
    @include('partials.hero')
@endif
