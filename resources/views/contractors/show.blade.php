@extends('layouts/default')

@section('title', "Dane Kontrahenta")

@section('content')
    <div class="container mt-5">
        {{-- Financial data --}}
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Dane finansowe</h2>
                Do zrobienia.
            </div>
        </div>
        {{-- Contractor data --}}
        <div class="card mt-5">
            <div class="card-body">
                <h2 class="card-title">Dane kontrahenta</h2>
                <div class="row">
                    <div class="col-md-12">
                        <b>Nazwa firmy:</b> {{$contractor->name}}
                    </div>
                    <div class="col-md-12">
                        <b>NIP: </b> {{$contractor->NIP}}
                    </div>
                    <div class="col-md-12">
                        <b>Data dołączenia:</b> {{$contractor->join_date->format("d M y")}}
                    </div>
                    <div class="col-md-12">
                        <b>Adres:</b> {{$contractor->street}}, {{$contractor->postal_code}} {{$contractor->city}}, {{$contractor->country}}
                    </div>
                </div>
            </div>
        </div>
        {{-- Departaments data --}}
        <div class="card mt-5">
            <div class="card-body">
                <h2 class="card-title">Oddziały</h2>
                Do zrobienia.
            </div>
        </div>
        {{-- Departaments data --}}
        <div class="card mt-5">
            <div class="card-body">
                <h2 class="card-title">Osoby kontaktowe</h2>
                Do zrobienia.
            </div>
        </div>
    </div>
@endsection
