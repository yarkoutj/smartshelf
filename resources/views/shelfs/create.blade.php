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
                  <label for="name">Ubicación</label>
                  <input type="text" class="form-control" id="ubication" name="ubication" value="{{old('ubication')}}"/>
              </div>
              <div class="form-group">
                  <input type="hidden" id="code" name="code" value="0"/>
              </div>
           <button type="submit" class="btn btn-success">Crear estante</button>
          </form>
        </div>
    </div>
@endsection
