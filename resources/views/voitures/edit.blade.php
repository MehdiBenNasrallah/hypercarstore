@extends('layouts.app')

@section('content')

    <h1>Modifier la voiture : {{ $voiture->marque }} - {{ $voiture->modele }}</h1>

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form method="post" action="{{ url('voitures/'. $voiture->id) }}">
        @method('PATCH')
        @csrf

        <div class="form-group mb-3">
            <label for="marque">Marque:</label>
            <input type="text" class="form-control" id="marque" placeholder="Entrez la marque" name="marque" value="{{ $voiture->marque }}">
        </div>

        <div class="form-group mb-3">
            <label for="annee">Année:</label>
            <input type="number" class="form-control" id="annee" placeholder="Entrez l'année" name="annee" value="{{ $voiture->annee }}">
        </div>

        <div class="form-group mb-3">
            <label for="modele">Modèle:</label>
            <input type="text" class="form-control" id="modele" placeholder="Entrez le modèle" name="modele" value="{{ $voiture->modele }}">
        </div>

        <div class="form-group mb-3">
            <label for="valeur">Valeur:</label>
            <input type="number" class="form-control" id="valeur" placeholder="Entrez la valeur en $" name="valeur" value="{{ $voiture->valeur }}">
        </div>

        <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $voiture->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ url('voitures/'. $voiture->id) }}" class="btn btn-info">Annuler</a>  
    </form>

@endsection
