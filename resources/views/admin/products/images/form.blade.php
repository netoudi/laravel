@extends('app')

@section('content')

    <div class="container">

        <h3>Upload Image</h3><br><br>

        @include('errors._check')

        {!! Form::open(['route' => ['admin.products.images.store', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
            {!! Form::label('image', 'Image:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::file('image', null, ['class' => 'btn bg-primary btn-sm form-control']) !!}
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Save', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.products.images.index', ['id' => $product->id]) }}" role="button">Cancel</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection
