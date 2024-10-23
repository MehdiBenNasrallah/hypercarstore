@extends('layouts.app')


@section('content')


    <h1>Modifier article: {{ $article->titre }}</h1>


    <h1>Ajouter un article</h1>
    @if ($message = Session::get('warning'))

        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>

    @endif

    <form method="post" action="{{ url('articles/'. $article->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="title">Titre:</label>
            <input type="text" class="form-control" id="title" placeholder="Entrer titre" name="title" value="{{ $article->titre }}">

        </div>

        <div class="form-group mb-3">

            <label for="content">Ajouter le contenu:</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $article->content }}</textarea>

        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
       
            <a href="{{ url('articles/'. $article->id) }}" class="btn btn-info">Annuler</a>  
    </form>
   
  
@endsection