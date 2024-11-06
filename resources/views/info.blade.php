@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('general.apropos')</div>

                    <div class="card-body">
                        <h3>@lang('general.project_description')</h3>
                        <p>@lang('general.site_description')</p>

                        <h4>@lang('general.database_schema')</h4>
                        <div class="text-center">
                            <img src="{{ asset('images/database_schema.png') }}" alt="Schéma de la base de données" class="img-fluid">
                        </div>

                        <h5>@lang('general.references')</h5>
                        <ul>
                            <li><a href="https://www.example.com" target="_blank">@lang('general.example_link_1')</a></li>
                            <li><a href="https://www.example2.com" target="_blank">@lang('general.example_link_2')</a></li>
                        </ul>

                        <p>@lang('general.site_contact_info')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
