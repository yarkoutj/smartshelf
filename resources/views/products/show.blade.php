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
                    <input type="number" class="form-control" id="shelf_id" name="shelf_id" min="1" max="10" value="{{$product->shelf_id}}" disabled/>
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="title" name="name" value="{{$product->name}}" disabled/>
                    <label for="weight">Peso unitario prom.</label>
                    <input type="text" class="form-control" id="weight" name="weight" value="{{$product->weight}}" disabled/>
                    <label for="state">Estatus</label>
                    <input type="text" class="form-control" id="state" name="state" value="{{$product->state}}" disabled/>
                    <label for="stockmin">Inventario mínimo</label>
                    <input type="text" class="form-control" id="stockmin" name="stockmin" value="{{$product->stockmin}}" disabled/>
                    <label for="stockmax">Inventario máximo</label>
                    <input type="text" class="form-control" id="stockmax" name="stockmax" value="{{$product->stockmax}}" disabled/>
                    <label for="quantity">Cantidad</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}" disabled/>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-primary">< Regresar</a>
            </form>
        </div>
    </div>
@endsection
