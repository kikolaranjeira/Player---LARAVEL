<nav>
    <div class="d-flex justify-content-center"> <!-- Add justify-content-center class here -->
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
    </div> <!-- Close the parent div -->
</nav> <!-- Add closing tag for the nav element -->

<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    <div class="container">
        <div class="navbar-brand">Players | CRUD</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item @if(Request::is('players')) active @endif">
                    <a class="nav-link" href="{{ url('players') }}">Players List <span class="sr-only">(current)</span></a>
                <a class="nav-item @if(Request::is('players/create')) active @endif">
                    <a class="nav-link" href="{{ url('players/create') }}">Add Player</a>
            </div>
        </div>
        <form action="{{ url('players') }}" method="GET" role="search" class="form-inline my-2 my-lg-0">
            <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
