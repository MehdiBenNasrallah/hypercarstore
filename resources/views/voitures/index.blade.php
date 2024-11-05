@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-lg-10">
            <h2>Liste des voitures</h2>
        </div>

        <div class="col-lg-2">
            <a class="btn btn-success" href="{{ url('voitures/create') }}">Ajouter une voiture</a>
        </div>

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            @foreach ($voitures as $voiture)
                <div class="col-md-4">
                    <div class="card card-body">
                        {{-- Affichage des détails de la voiture --}}
                        <h2>{{ $voiture->marque }} - {{ $voiture->modele }}</h2>
                        <p>Année : {{ $voiture->annee }}</p>
                        <p>Valeur : {{ $voiture->valeur }} $</p>
                        <p>{{ $voiture->description }}</p>
                        @if ($voiture->photo)
                            <div>
                                <img src="{{ asset('storage/' . $voiture->photo) }}" alt="Photo actuelle" style="width: 200px;">
                            </div>
                        @endif

                        <hr>

                        <a href="{{ url('voitures/'. $voiture->id) }}" class="btn btn-outline-primary">En savoir plus</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
