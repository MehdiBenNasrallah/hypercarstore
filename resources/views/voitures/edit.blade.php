@extends('layouts.app')

@section('content')

<h1>Modifier la voiture: {{ $voiture->marque }} {{ $voiture->modele }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form method="post" action="{{ url('admin/voitures/'. $voiture->id) }}" enctype="multipart/form-data">
    @method('GET')
    @csrf

    <div class="form-group mb-3">
        <label for="marque">Marque:</label>
        <input type="text" class="form-control" id="marque" placeholder="Entrez la marque" name="marque" value="{{ $voiture->marque }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="modele">Modèle:</label>
        <input type="text" class="form-control" id="modele" placeholder="Entrez le modèle" name="modele" value="{{ $voiture->modele }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="annee">Année:</label>
        <input type="number" class="form-control" id="annee" placeholder="Entrez l'année" name="annee" value="{{ $voiture->annee }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="valeur">Valeur:</label>
        <input type="number" class="form-control" id="valeur" placeholder="Entrez la valeur" name="valeur" value="{{ $voiture->valeur }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="description">Description:</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required>{{ $voiture->description }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="photo">Photo de la voiture:</label>
        <input type="file" class="form-control" id="photo" name="photo">
        @if ($voiture->photo)
            <div>
                <img src="{{ asset('storage/' . $voiture->photo) }}" alt="Photo actuelle" style="width: 300px;">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    <a href="{{ url('voitures/'. $voiture->id) }}" class="btn btn-info">Annuler</a>
</form>

@endsection
