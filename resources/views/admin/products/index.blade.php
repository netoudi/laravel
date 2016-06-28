@extends('app')

@section('content')

    <div class="container">

        <h3>Products</h3>

        <div class="text-right">
            <a href="{{ route('admin.products.create') }}" class="btn btn-default btn-sm">New Product</a>
        </div>

        <br>

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <th width="5%">Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th width="8%">Price</th>
            <th width="8%">Featured</th>
            <th width="8%">Recommend</th>
            <th width="18%">Action</th>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ str_limit(strip_tags($product->name), 40, '...') }}</td>
                    <td>{{ str_limit(strip_tags($product->description), 40, '...') }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>$ {{ number_format((double) $product->price, 2) }}</td>
                    <td>{{ ($product->featured) ? 'yes' : 'no' }}</td>
                    <td>{{ ($product->recommend) ? 'yes' : 'no' }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.products.show', ['id' => $product->id]) }}" class="btn btn-primary btn-xs">View</a>
                        <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                        <a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $products->render() !!}

    </div>{{--/container--}}

@endsection