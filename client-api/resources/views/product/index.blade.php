@extends('templates.base')
@section('title','Productos')
@section('header', 'Productos')
@section('content')

    <div class="row">
        <div class="col-lg-12 mb-4 d-grid gap-2 d-md-block">
            <a href="{{ route('producto.create') }}" class="btn btn-primary">Crear</a>
        </div>
    </div>    
    
    @include('templates.messages')

    <div class="row">
        <div class="col-lg-12 mb-4">
            <table id="table_data" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <body>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['id'] }}</td>
                        <td>{{ $product['description'] }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product['id']) }}" class="btn btn-primary btn-circle btn-sm" title="Editar"><i class="far fa-edit"></i>
                            </a>
                            <a href="{{ route('product.destroy', $product['id']) }}" class="btn btn-danger btn-circle btn-sm" class="Eliminar" onclick="return remove();"><i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </body>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/general.js') }}"></script>
@endsection