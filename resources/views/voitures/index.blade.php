@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-lg-10">
            <h2>@lang('general.car_list')</h2>
        </div>

        <div class="col-lg-2">
            @if (Auth::check() && Auth::user()->isAdmin())
                <a class="btn btn-success" href="{{ url('admin/voitures/create') }}">@lang('general.add_car')</a>
            @endif
        </div>

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            @foreach ($voitures as $voiture)
                <div class="col-md-4">
                    <div class="card card-body">
                        {{-- Affichage des détails de la voiture --}}
                        <h2>{{ $voiture->marque }} - {{ $voiture->modele }}</h2>
                        <p>@lang('general.year'): {{ $voiture->annee }}</p>
                        <p>@lang('general.value'): {{ $voiture->valeur }} $</p>
                        <p>{{ $voiture->description }}</p>
                        @if ($voiture->photo)
                            <div>
                                <img src="{{ asset('storage/' . $voiture->photo) }}" alt="@lang('general.current_photo')" style="width: 200px;">
                            </div>
                        @endif

                        <hr>

                        <a href="{{ url('voitures/'. $voiture->id) }}" class="btn btn-outline-primary">@lang('general.learn_more')</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection