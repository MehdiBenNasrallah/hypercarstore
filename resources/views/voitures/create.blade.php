@extends('layouts.app')

@section('content')

<h1>Ajouter une voiture</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form action="{{ route('voitures.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label for="marque">Marque:</label>
        <input type="text" class="form-control" id="marque" placeholder="Entrez la marque" name="marque" required>
    </div>

    <div class="form-group mb-3">
        <label for="modele">Modèle:</label>
        <input type="text" class="form-control" id="modele" placeholder="Entrez le modèle" name="modele" required>
    </div>

    <div class="form-group mb-3">
        <label for="annee">Année:</label>
        <input type="number" class="form-control" id="annee" placeholder="Entrez l'année" name="annee" required>
    </div>

    <div class="form-group mb-3">
        <label for="valeur">Valeur:</label>
        <input type="number" class="form-control" id="valeur" placeholder="Entrez la valeur" name="valeur" required>
    </div>

    <div class="form-group mb-3">
        <label for="description">Description:</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="photo">Photo de la voiture:</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>

    <button type="submit" class="btn btn-primary">Ajouter la voiture</button>
    <a href="{{ url('/') }}" class="btn btn-info">Retour à la page d'accueil</a>  
</form>

@endsection