@extends('app')

@section('content')

    <div class="container">

        <h3>Category Details</h3>

        <div class="text-right">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-default btn-sm">Back</a>
            <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" class="btn btn-danger btn-sm">Delete</a>
        </div>

        <br>

        <dl class="dl-horizontal">
            <dt>Name:</dt>
            <dd>{{ $category->name }}</dd>
            <hr>
            <dt>Description:</dt>
            <dd>{{ $category->description }}</dd>
        </dl>

    </div>{{--/container--}}

@endsection
