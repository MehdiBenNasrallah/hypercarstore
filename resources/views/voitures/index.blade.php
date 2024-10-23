@extends('layouts.app')

    
@section('content')

    <div class="row">

        <div class="col-lg-10">
            <h2>Liste des articles</h2>
        </div>

        <div class="col-lg-2">
            <a class="btn btn-success" href="{{ url('articles/create') }}">Ajouter un article</a>
        </div>

    </div>



    @if ($message = Session::get('success'))

        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>

    @endif



<div class="container">

    <div class="row">
        @foreach ($articles as $index => $article)
        <div class="col-md-4">
            <div class="card card-body">
         {{--  si vous voulez avoir le titre de votre données cliquable (ici c'est le titre de l'article) utiliser le bout de code ci-bas>    
               {{--  <a href="{{ url('articles/'. $article->id) }}">
                <h2>
                        {{ $article->title }}
                    </h2>
                   
                </a>  --}}
               
                    <h2>
                            {{ $article->title }}
                        </h2>

                {{ $article->content }}
                          
            <a href="{{ url('articles/'. $article->id) }}" class="btn btn-outline-primary">En savoir plus</a> 
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection 