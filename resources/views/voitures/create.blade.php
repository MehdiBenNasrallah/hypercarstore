@extends('layouts.app')

@section('content')

    <h1>Ajouter une voiture</h1>
    
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('voitures.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="marque">Marque:</label>
            <input type="text" class="form-control" id="marque" placeholder="Entrez la marque" name="marque">
        </div>

        <div class="form-group mb-3">
            <label for="annee">Année:</label>
            <input type="number" class="form-control" id="annee" placeholder="Entrez l'année" name="annee">
        </div>

        <div class="form-group mb-3">
            <label for="modele">Modèle:</label>
            <input type="text" class="form-control" id="modele" placeholder="Entrez le modèle" name="modele">
        </div>

        <div class="form-group mb-3">
            <label for="valeur">Valeur:</label>
            <input type="number" class="form-control" id="valeur" placeholder="Entrez la valeur en $" name="valeur">
        </div>

        <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Entrez une description de la voiture"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>    
        <a href="{{ url('/') }}" class="btn btn-info">Retour à la page d'accueil</a>  
    </form>

@endsection
