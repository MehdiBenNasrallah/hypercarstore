@extends('layouts.app')

@section('content')

<h1>@lang('general.edit_car'): {{ $voiture->marque }} {{ $voiture->modele }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form method="post" action="{{ url('admin/voitures/'. $voiture->id) }}" enctype="multipart/form-data">
    @method('GET')
    @csrf

    <div class="form-group mb-3">
        <label for="marque">@lang('general.brand'):</label>
        <input type="text" class="form-control" id="marque" placeholder="@lang('general.enter_brand')" name="marque" value="{{ $voiture->marque }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="modele">@lang('general.model'):</label>
        <input type="text" class="form-control" id="modele" placeholder="@lang('general.enter_model')" name="modele" value="{{ $voiture->modele }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="annee">@lang('general.year'):</label>
        <input type="number" class="form-control" id="annee" placeholder="@lang('general.enter_year')" name="annee" value="{{ $voiture->annee }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="valeur">@lang('general.value'):</label>
        <input type="number" class="form-control" id="valeur" placeholder="@lang('general.enter_value')" name="valeur" value="{{ $voiture->valeur }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="description">@lang('general.description'):</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required>{{ $voiture->description }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="photo">@lang('general.car_photo'):</label>
        <input type="file" class="form-control" id="photo" name="photo">
        @if ($voiture->photo)
            <div>
                <img src="{{ asset('storage/' . $voiture->photo) }}" alt="@lang('general.current_photo')" style="width: 300px;">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">@lang('general.save_changes')</button>
    <a href="{{ url('voitures/'. $voiture->id) }}" class="btn btn-info">@lang('general.cancel')</a>
</form>

@endsection
