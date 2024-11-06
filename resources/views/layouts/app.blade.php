<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery and jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <a class="navbar-brand" href="{{ url('/info') }}">@lang("general.apropos")</a>

                        <form class="form-inline my-2 my-lg-0 position-relative">
                            <input class="form-control mr-sm-2" type="search" placeholder="Recherche voiture" aria-label="Search" id="search">
                            <div id="search-results" class="list-group position-absolute" style="display: none;"></div>
                        </form>

                        <!-- Bloc multilingue -->
                        <ul class="navbar-nav ms-auto">
                            @php $locale = session()->get('locale'); @endphp
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img id="language-flag" src="{{ asset('/images/' . ($locale === 'fr' ? 'fr.png' : 'en.png')) }}" width="30px" height="20px">
                                    <span id="language-text">{{ $locale === 'fr' ? 'Français' : 'English' }}</span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('lang', ['locale' => 'en']) }}">
                                        <img src="{{ asset('images/en.png') }}" width="30px" height="20px"> English
                                    </a>
                                    <a class="dropdown-item" href="{{ route('lang', ['locale' => 'fr']) }}">
                                        <img src="{{ asset('images/fr.png') }}" width="30px" height="20px"> Français
                                    </a>
                                </div>

                            </li>
                        </ul>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <!-- Links d'administration uniquement visibles par les admins -->
                                    @if (Auth::check() && Auth::user()->isAdmin())
                                        <a class="dropdown-item" href="{{ url('/admin/voitures') }}">Gestion des voitures</a>
                                        <a class="dropdown-item" href="{{ url('/admin/voitures/create') }}">Ajouter une voiture</a>
                                    @else
                                        {{ Log::info('User is not admin', ['user_id' => Auth::user()->id, 'role' => Auth::user()->role]) }}
                                    @endif
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let query = $(this).val();

                if (query.length > 2) { // Commence à chercher après 3 caractères
                    $.ajax({
                        url: "{{ route('voitures.autocomplete') }}",
                        method: "GET",
                        data: { query: query },
                        success: function(data) {
                            $('#search-results').empty().show();
                            $.each(data, function(index, voiture) {
                                $('#search-results').append('<a href="/voitures/' + voiture.id + '" class="list-group-item list-group-item-action">' + voiture.marque + ' ' + voiture.modele + '</a>');
                            });
                        }
                    });
                } else {
                    $('#search-results').hide(); // Masque les résultats si moins de 3 caractères
                }
            });

            // Masquer les résultats lorsque l'utilisateur clique ailleurs
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search-results').length && !$(e.target).is('#search')) {
                    $('#search-results').hide();
                }
            });
        });
    </script>
</body>
</html>
