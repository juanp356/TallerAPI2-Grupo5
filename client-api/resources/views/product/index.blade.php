@extends('templates.base')
@section('title','Productos')
@section('header', 'Productos')
@section('content')

    <div class="row">
        <div class="col-lg-12 mb-4 d-grid gap-2 d-md-block">
            <a href="{{ route('product.create') }}" class="btn btn-primary">Crear</a>
        </div>
    </div>    
    
    @include('templates.messages')

    <div class="row">
        <div class="col-lg-12 mb-4">
            <table id="table_data" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <body>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product['category'] }}</td>
                            <td>{{ $product['price'] }}</td>
                            <td>{{ $product['stock'] }}</td>
                            <td>
                                <a href="{{ route('product.edit', $product['id']) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('product.destroy', $product['id']) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                        Eliminar
                                    </button>
                                </form>
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