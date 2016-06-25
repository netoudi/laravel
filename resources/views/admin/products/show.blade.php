@extends('app')

@section('content')

    <div class="container">

        <h3>Product Details</h3>

        <div class="text-right">
            <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm">Back</a>
            <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" class="btn btn-danger btn-sm">Delete</a>
        </div>

        <br>

        <dl class="dl-horizontal">
            <dt>Name:</dt>
            <dd>{{ $product->name }}</dd>
            <hr>
            <dt>Description:</dt>
            <dd>{{ $product->description }}</dd>
            <hr>
            <dt>Price:</dt>
            <dd>$ {{ number_format((double) $product->price, 2) }}</dd>
            <hr>
            <dt>Featured:</dt>
            <dd>{{ ($product->featured) ? 'yes' : 'no' }}</dd>
            <hr>
            <dt>Recommend:</dt>
            <dd>{{ ($product->recommend) ? 'yes' : 'no' }}</dd>
        </dl>

    </div>{{--/container--}}

@endsection
