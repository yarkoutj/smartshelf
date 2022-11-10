@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
            <h3>Capturar producto</h3>
        </div>
    </div>
    <div class="row">
          <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
                  <label for="shelf_id">ID del estante:</label>
                  <input type="number" class="form-control" id="shelf_id" name="shelf_id" min="1" max="10" value="{{old('shelf_id')}}"/>
              </div>
              <div class="form-group">
                   <label for="name">Nombre</label>
                   <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}"/>
              </div>
              <div class="form-group">
                   <input type="hidden" id="weight" name="weight" value="0"/>
                   <input type="hidden" id="state" name="state" value="A"/>
                   <input type="hidden" id="stockmin" name="stockmin" value="0"/>
                   <input type="hidden" id="stockmax" name="stockmax" value="0"/>
                   <input type="hidden" id="quantity" name="quantity" value="0"/>
              </div>
              <button type="submit" class="btn btn-success">Crear producto</button>
            </form>
        </div>
    </div>
@endsection
