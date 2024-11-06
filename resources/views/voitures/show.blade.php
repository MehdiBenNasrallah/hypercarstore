@extends('layouts.app')

@section('content')

    <h1>{{ $voiture->marque }} - {{ $voiture->modele }}</h1>
    <p>Année : {{ $voiture->annee }}</p>
    <p>Valeur : {{ $voiture->valeur }} $</p>
    <p>Description : {{ $voiture->description }}</p>

    @if ($voiture->photo)
    <div>
        <img src="{{ asset('storage/' . $voiture->photo) }}" alt="Photo actuelle" style="width: 300px;">
    </div>
    @endif

    @if (Auth::check() && Auth::user()->isAdmin())
        <a href="{{ url('admin/voitures/'. $voiture->id . '/edit') }}" class="btn btn-primary">Modifier</a>
        <form action="{{ url('admin/voitures/'. $voiture->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    @endif

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

    @if (Auth::check() && !Auth::user()->isAdmin())
        <h3>Ajouter une offre</h3>
        
        <form action="{{ route('offres.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-success">Soumettre l'offre</button>
        </form>
    @endif

@endsection
