@extends('layouts.app')

@section('content')

    <h1>{{ $voiture->marque }} - {{ $voiture->modele }}</h1>
    <p>Année : {{ $voiture->annee }}</p>
    <p>Valeur : {{ $voiture->valeur }} $</p>
    <p>Description : {{ $voiture->description }}</p>

    <a href="{{ url('voitures/'. $voiture->id . '/edit') }}" class="btn btn-primary">Modifier</a>
    <a href="{{ url('/') }}" class="btn btn-secondary">Retour à la liste</a>

    <hr>

    <h2>Offres pour cette voiture</h2>

    @if ($voiture->offres->isEmpty())
        <p>Aucune offre pour cette voiture pour le moment.</p>
    @else
        <div class="list-group">
            @foreach ($voiture->offres as $offre)
                <div class="list-group-item">
                    <p><strong>Prix :</strong> {{ $offre->prix }} $</p>
                    <p><strong>Message :</strong> {{ $offre->message }}</p>
                    <p><strong>Utilisateur :</strong> {{ $offre->user->name }}</p>
                </div>
            @endforeach
        </div>
    @endif

@endsection
