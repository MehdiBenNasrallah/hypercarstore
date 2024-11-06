@extends('layouts.app')

@section('content')

    <h1>{{ $voiture->marque }} - {{ $voiture->modele }}</h1>
    <p>@lang('general.year'): {{ $voiture->annee }}</p>
    <p>@lang('general.value'): {{ $voiture->valeur }} $</p>
    <p>@lang('general.description'): {{ $voiture->description }}</p>

    @if ($voiture->photo)
    <div>
        <img src="{{ asset('storage/' . $voiture->photo) }}" alt="@lang('general.current_photo')" style="width: 300px;">
    </div>
    @endif

    @if (Auth::check() && Auth::user()->isAdmin())
        <a href="{{ url('admin/voitures/'. $voiture->id . '/edit') }}" class="btn btn-primary">@lang('general.edit')</a>
        <form action="{{ url('admin/voitures/'. $voiture->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">@lang('general.delete')</button>
        </form>
    @endif

    <a href="{{ url('/') }}" class="btn btn-secondary">@lang('general.back_to_list')</a>

    <hr>

    <h2>@lang('general.offers_for_car')</h2>

    @if ($voiture->offres->isEmpty())
        <p>@lang('general.no_offers')</p>
    @else
        <div class="list-group">
            @foreach ($voiture->offres as $offre)
                <div class="list-group-item">
                    <p><strong>@lang('general.price'):</strong> {{ $offre->prix }} $</p>
                    <p><strong>@lang('general.message'):</strong> {{ $offre->message }}</p>
                    <p><strong>@lang('general.user'):</strong> {{ $offre->user->name }}</p>
                </div>
            @endforeach
        </div>
    @endif

    @if (Auth::check() && !Auth::user()->isAdmin())
        <h3>@lang('general.add_offer')</h3>
        
        <form action="{{ route('offres.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="prix">@lang('general.price')</label>
                <input type="text" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="message">@lang('general.message')</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-success">@lang('general.submit_offer')</button>
        </form>
    @endif

@endsection