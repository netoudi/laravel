@extends('app')

@section('content')

    <div class="container">

        <h3>Images of {{ $product->name }}</h3>

        <div class="text-right">
            <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm">Back</a>
            <a href="{{ route('admin.products.images.create', $product->id) }}" class="btn btn-primary btn-sm">New Image</a>
        </div>

        <br>

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <th width="5%">Id</th>
            <th>Image</th>
            <th>Extension</th>
            <th width="18%">Action</th>
            </thead>
            <tbody>
            @foreach($product->images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td><img src="{{ url('uploads/' . $image->id . '.' . $image->extension) }}" width="80"></td>
                    <td>{{ $image->extension }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.products.images.destroy', ['id' => $image->product->id, 'idImage' => $image->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>{{--/container--}}

@endsection
