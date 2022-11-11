@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
            <h3>Capturar estante</h3>
        </div>
    </div>
    <div class="row">
          <form action="{{route('shelfs.store')}}" method="post" enctype="multipart/form-data" class="col-lg-7">
              {!! csrf_field() !!}
              @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach($errors->all() as $error)
                              <li>{{$error}}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="form-group">
                  <label for="name">Estante (Alfabético)</label>
                  <input type="text" class="form-control" id="shelf" name="shelf" value="{{old('shelf')}}"/>
              </div>
              <div class="form-group">
                  <label for="name">Nivel (Numérico)</label>
                  <input type="number" class="form-control" id="level" name="level" value="{{old('level')}}"/>
              </div>
              <div class="form-group">
                  <input type="hidden" id="state" name="state" value="Activo"/>
              </div>
              <div class="form-group">
                  <input type="hidden" id="shelf_id" name="shelf_id" value="{{old('shelf')}}{{old('level')}}"/>
              </div>
           <button type="submit" class="btn btn-success">Crear estante</button>
          </form>
        </div>
    </div>
@endsection
