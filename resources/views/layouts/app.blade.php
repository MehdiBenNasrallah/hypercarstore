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
                <a class="navbar-brand" href="{{ url('/info') }}">Info</a>

                <form class="form-inline my-2 my-lg-0 position-relative">
                    <input class="form-control mr-sm-2" type="search" placeholder="Recherche voiture" aria-label="Search" id="search">
                    <div id="search-results" class="list-group position-absolute" style="display: none;"></div>
                </form>
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
