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

    <style>
        .language-buttons {
            display: flex;
            gap: 10px;
        }

        .language-buttons .btn {
            padding: 5px 10px;
        }

        .language-buttons .btn.active {
            background-color: #007bff;
            color: white;
        }

        .language-buttons .btn img {
            margin-right: 5px;
        }

        #search-results {
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            position: absolute;
            z-index: 1000;
            background-color: white;
        }

        #search-results a {
            cursor: pointer;
        }

        #search-results a:hover {
            background-color: #f1f1f1;
        }
    </style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('general.toggle_navigation')">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <a class="navbar-brand" href="{{ url('/info') }}">@lang("general.apropos")</a>

                        <form class="form-inline my-2 my-lg-0 position-relative">
                            <input class="form-control mr-sm-2" type="search" placeholder="@lang('general.search_car')" aria-label="Search" id="search">
                            <div id="search-results" class="list-group position-absolute" style="display: none;"></div>
                        </form>

                        <!-- Bloc multilingue -->
                        <ul class="navbar-nav ms-auto">
                            @php $locale = session()->get('locale'); @endphp
                            <div class="language-buttons">
                                <a href="{{ route('lang', ['locale' => 'fr']) }}" class="btn btn-outline-primary {{ $locale === 'fr' ? 'active' : '' }}">
                                    <img src="{{ asset('images/fr.png') }}" width="30px" height="20px"> @lang('general.french')
                                </a>
                                <a href="{{ route('lang', ['locale' => 'en']) }}" class="btn btn-outline-primary {{ $locale === 'en' ? 'active' : '' }}">
                                    <img src="{{ asset('images/en.png') }}" width="30px" height="20px"> @lang('general.english')
                                </a>
                                <a href="{{ route('lang', ['locale' => 'es']) }}" class="btn btn-outline-primary {{ $locale === 'es' ? 'active' : '' }}">
                                    <img src="{{ asset('images/es.png') }}" width="30px" height="20px"> @lang('general.spanish')
                                </a>
                            </div>

                        </ul>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">@lang('general.login')</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">@lang('general.register')</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>

                            <div class="btn-group" role="group" aria-label="User Actions">
                                <!-- Bouton de déconnexion -->
                                <button class="btn btn-outline-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    @lang('general.logout')
                                </button>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <!-- Boutons d'administration visibles uniquement pour les administrateurs -->
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <a href="{{ url('/admin/voitures') }}" class="btn btn-outline-secondary">@lang('general.car_management')</a>
                                    <a href="{{ url('/admin/voitures/create') }}" class="btn btn-outline-secondary">@lang('general.add_car')</a>
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
