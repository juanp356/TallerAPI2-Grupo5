@extends('templates.base')

@section('title','Crear productos')
@section('header', 'Crear productos')

@section('content')
    @include('templates.messages')
    <div class="row">
        <div class="col-lg-12 mb-4">
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-lg-6 mb-4">
                        <label for="title">Título</label>
                        <input type="text" class="form-control" name="title" id="title" required value="{{ old('title') }}">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="description">Descripción</label>
                        <input type="text" class="form-control" name="description" id="description" required value="{{ old('description') }}">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="category">Categoría</label>
                        <input type="text" class="form-control" name="category" id="category" required value="{{ old('category') }}">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="price">Precio</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" required value="{{ old('price') }}">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" required value="{{ old('stock') }}">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="images">Imagen (URL)</label>
                        <input type="text" class="form-control" name="images" id="images" value="{{ old('images') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
