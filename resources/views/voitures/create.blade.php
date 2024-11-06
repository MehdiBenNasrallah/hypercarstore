@extends('layouts.app')

@section('content')

<h1>@lang("general.add_car")</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form action="{{ route('voitures.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label for="marque">@lang("general.brand"):</label>
        <input type="text" class="form-control" id="marque" placeholder="@lang('general.enter_brand')" name="marque" required>
    </div>

    <div class="form-group mb-3">
        <label for="modele">@lang("general.model"):</label>
        <input type="text" class="form-control" id="modele" placeholder="@lang('general.enter_model')" name="modele" required>
    </div>

    <div class="form-group mb-3">
        <label for="annee">@lang("general.year"):</label>
        <input type="number" class="form-control" id="annee" placeholder="@lang('general.enter_year')" name="annee" required>
    </div>

    <div class="form-group mb-3">
        <label for="valeur">@lang("general.value"):</label>
        <input type="number" class="form-control" id="valeur" placeholder="@lang('general.enter_value')" name="valeur" required>
    </div>

    <div class="form-group mb-3">
        <label for="description">@lang("general.description"):</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="photo">@lang("general.car_photo"):</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>

    <button type="submit" class="btn btn-primary">@lang("general.add_car")</button>
    <a href="{{ url('/') }}" class="btn btn-info">@lang("general.back_home")</a>  
</form>

@endsection