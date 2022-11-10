@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
            <h3>Editar producto: {{$product->name}}</h3>
            </div>
        </div>
        <div class="row">
            <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
                    <label for="shelf_id">ID del estante:</label>
                    <input type="number" class="form-control" id="shelf_id" name="shelf_id" min="1" max="10" value="{{$product->shelf_id}}"/>
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}"/>
                    <label for="weight">Peso</label>
                    <input type="text" class="form-control" id="weight" name="weight" value="{{$product->weight}}"/>
                    <label for="state">Estado</label>
                    <select class="form-control" id="state" name="state" value="{{$product->state}}">
                        <option value="">{{$product->state}}</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                    <label for="stockmin">Stock mínimo</label>
                    <input type="text" class="form-control" id="stockmin" name="stockmin" value="{{$product->stockmin}}"/>
                    <label for="stockmax">Stock máximo</label>
                    <input type="text" class="form-control" id="stockmax" name="stockmax" value="{{$product->stockmax}}"/>
                    <label for="quantity">Cantidad</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}"/>
                </div>
            <button type="submit" class="btn btn-success">Editar producto</button>
            </form>
        </div>
    </div>
@endsection
