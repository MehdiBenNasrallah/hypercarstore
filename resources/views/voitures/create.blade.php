@extends('layouts.app')


@section('content')

    <h1>Ajouter une voiture</h1>
    @if ($message = Session::get('warning'))

        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>

    @endif

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        

        <div class="form-group mb-3">
            <label for="title">Titre:</label>
            <input type="text" class="form-control" id="title" placeholder="Entrez un titre" name="title">
        </div>


        <div class="form-group mb-3">

            <label for="content">Ajouter le contenu:</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
          <input type="hidden" name="user_id" value="<?= 1?>" /><br />
          </div>

        <button type="submit" class="btn btn-primary">Publier</button>    <a href="{{ url('/') }}" class="btn btn-info">Retour à la page d'accueil</a>  

    </form>

@endsection