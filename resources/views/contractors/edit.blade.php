@extends('layouts/default')

@section('title', "Tworzenie Kontrahenta")

@section('content')
    <div class="container mt-5">
        {{-- Filters --}}
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edytuj kontrahenta</h2>
                <form method="POST" action="{{route('contractors.update', ['contractor' => $contractor])}}">
                    @csrf
                    @method("PUT")
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="name">Nazwa firmy:</label>
                        <input type="text" name="name" placeholder="np. Polmix" class="form-control" id="name" value="{{$contractor->name}}" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="nip">NIP</label>
                          <input lenght="10" type="text" placeholder="np. 32832.. (10 cyfr)" name="nip" class="form-control" id="nip" value="{{$contractor->NIP}}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="street">Ulica i numer budynku</label>
                        <input type="text" class="form-control" name="street" id="street" placeholder="np. Warszawska 13" value="{{$contractor->street}}" required>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="city">Miasto</label>
                          <input type="text" placeholder="np. Rzeszów" name="city" class="form-control" id="city" value="{{$contractor->city}}" required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="postal_code">Kod pocztowy</label>
                          <input type="text" placeholder="np. 35-202" class="form-control" name="postal_code" id="postal_code" value="{{$contractor->postal_code}}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="country">Kraj</label>
                            <input type="text" placeholder="np. Polska" class="form-control" name="country" id="country" value="{{$contractor->country}}" required>
                          </div>
                      </div>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </form>
          </div>
    </div>
@endsection
