<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <!-- CSS da Aplicação -->
        <link rel="stylesheet" href="{{ url('/') }}/css/styles.css" />
        <script src="{{ url('/') }}/js/scripts.js"></script>

    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="{{ url('/') }}/" class="navbar-brand">
                        <img src="{{ url('/') }}/img/hdcevents_logo.svg" alt="HDC Events">
                    </a>  
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('events') }}" class="nav-link">Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('events.create') }}" class="nav-link">Create Events</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">My Events</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a href="{{ route('logout') }}" 
                                        class="nav-link"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        Sign out
                                    </a>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Sign up</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if (session('msg'))
                        <p class="msg">{{ session('msg') }}</p>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>

        
        <footer>HDC Events &copy; 2022</footer>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

        <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    </body>
</html>
