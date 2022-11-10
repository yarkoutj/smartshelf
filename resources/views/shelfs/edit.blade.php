@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
            <h3>Editar estante: {{$shelf->id}} / {{$shelf->ubication}}</h3>
        </div>
    </div>
    <div class="row">
          <form action="{{route('shelfs.update',$shelf->id)}}" method="post" enctype="multipart/form-data" class="col-lg-7">
              {!! csrf_field() !!}
              @method('PUT')
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
                  <label for="ubication">Ubicación</label>
                  <input type="text" class="form-control" id="ubication" name="ubication" value="{{$shelf->ubication}}"/>
                  <label for="state">Código</label>
                  <select class="form-control" id="code" name="code" value="{{$shelf->code}}">
                      <option value="">{{$shelf->code}}</option>
                      <option value="0">0</option>
                      <option value="1">1</option>
                  </select>
              </div>
              <button type="submit" class="btn btn-success">Editar estante</button>
          </form>
        </div>
    </div>
@endsection
