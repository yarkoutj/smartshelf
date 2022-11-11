@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Visualización de producto: {{$shelf->id}} / {{$shelf->ubication}}</h3>
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
                    <label for="shelf">Estante (Alfabético)</label>
                    <input type="text" class="form-control" id="shelf" name="shelf" value="{{$shelf->shelf}}" disabled/>
                    <label for="shelf">Nivel (Numérico)</label>
                    <input type="number" class="form-control" id="level" name="level" value="{{$shelf->level}}" disabled/>
                    <label for="state">Estado</label>
                    <select class="form-control" id="state" name="state" value="{{$shelf->state}}" disabled>
                        <option value="">{{$shelf->state}}</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                    <input type="hidden" class="form-control" id="shelf_id" name="shelf_id" value="{{$shelf->shelf_id}}" disabled/>
                </div>
                <a href="{{ route('shelfs.index') }}" class="btn btn-primary">< Regresar</a>
            </form>
        </div>
    </div>
@endsection
