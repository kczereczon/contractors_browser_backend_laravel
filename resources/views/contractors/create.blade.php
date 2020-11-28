@extends('layouts/default')

@section('title', "Tworzenie Kontrahenta")

@section('content')
    <div class="container mt-5">
        {{-- Form --}}
        <div class="card">
            <div class="card-body">
            <h2 class="card-title">Dodaj nowego kontrahenta</h2>
            <form method="POST" action="{{route('contractors.store')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="name">Nazwa firmy:</label>
                      <input type="text" name="name" placeholder="np. Polmix" class="form-control" id="name" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nip">NIP</label>
                      <input lenght="10" type="text" placeholder="np. 32832.. (10 cyfr)" name="nip" class="form-control" id="nip" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="street">Ulica i numer budynku</label>
                    <input type="text" class="form-control" name="street" id="street" placeholder="np. Warszawska 13" required>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="city">Miasto</label>
                      <input type="text" placeholder="np. Rzeszów" name="city" class="form-control" id="city" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="postal_code">Kod pocztowy</label>
                      <input type="text" placeholder="np. 35-202" class="form-control" name="postal_code" id="postal_code" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country">Kraj</label>
                        <input type="text" placeholder="np. Polska" class="form-control" name="country" id="country" required>
                      </div>
                  </div>
                <button type="submit" class="btn btn-primary">Dodaj</button>
                </form>
            </div>
        </div>
    </div>
@endsection
