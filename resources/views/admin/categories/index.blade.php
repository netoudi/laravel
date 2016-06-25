@extends('app')

@section('content')

    <div class="container">

        <h3>Categories</h3>

        <div class="text-right">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-default btn-sm">New Category</a>
        </div>

        <br>

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <th width="5%">Id</th>
            <th>Name</th>
            <th>Description</th>
            <th width="18%">Action</th>
            </thead>
            <tboty>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ str_limit(strip_tags($category->name), 40, '...') }}</td>
                        <td>{{ str_limit(strip_tags($category->description), 40, '...') }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.categories.show', ['id' => $category->id]) }}" class="btn btn-primary btn-xs">View</a>
                            <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                            <a href="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tboty>
        </table>

    </div>{{--/container--}}

@endsection
