@extends('layouts/default')

@section('title', "Kontrahenci")

@section('content')
    <div class="container mt-5">
        {{-- Filters --}}
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{route('contractors.index')}}" class="form-inline">
                    @csrf
                    <div class="form-group col-sm-12 col-lg-3 mb-2">
                      <label for="name" class="sr-only">Nazwa</label>
                    <input type="text" class="form-control w-100" name="name" placeholder="np. PSB Mrówka" value="{{$filters->name}}">
                    </div>
                    <div class="form-group col-sm-12 col-lg-3 mb-2">
                      <label for="nip" class="sr-only">NIP</label>
                      <input type="text" class="form-control w-100" name="nip" placeholder="np. 8213..." value="{{$filters->nip}}">
                    </div>
                    <div class="form-group col-sm-12 col-lg-3 mb-2">
                        <label for="address" class="sr-only">Adres</label>
                        <input type="text" class="form-control w-100" name="address" placeholder="np. Lwowska, lub Rzeszów" value="{{$filters->address}}">
                    </div>
                    <div class="col-sm-12 col-lg-3 mb-2">
                        <button type="submit" class="w-100 btn btn-primary">Wyszukaj</button>
                    </div>
                  </form>
            </div>
          </div>
          {{-- Table --}}
          <div class="card mt-2">
            <div class="card-body">
                <div class="col-sm-12 col-lg-3 mb-2">
                <a href="{{route('contractors.create')}}" class="w-100 btn btn-primary">+ Dodaj nową firmę </a>
                </div>
                <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Nazwa</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Data dołączenia</th>
                        <th scope="col">Adres</th>
                        <th scope="col">Akcja</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($contractors as $item)
                            <tr>
                                <td><a href="{{route("contractors.show", ['contractor' => $item])}}">{{$item->name}}</a></td>
                                <td>{{$item->NIP}}</td>
                                <td>{{$item->join_date->format('d M y')}}</td>
                                <td>{{$item->street}}, {{$item->postal_code}} {{$item->city}}, {{$item->country}}</td>
                                <td><a class="btn btn-warning" href="{{route("contractors.edit", ['contractor' => $item])}}">Edytuj</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $contractors->links("pagination::bootstrap-4") }}
                </div>
            </div>
          </div>
    </div>
@endsection
