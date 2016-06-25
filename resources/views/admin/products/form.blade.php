@extends('app')

@section('content')

    <div class="container">

        <h3>{{ empty($product) ? 'Add Product' : 'Update Product' }}</h3><br><br>

        @include('errors._check')

        @if(!empty($product))
            {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        @else
            {!! Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('price', 'Price:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('featured', 'Featured:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <label class="radio-inline">
                    {!! Form::radio('featured', true, false) !!} yes
                </label>
                <label class="radio-inline">
                    {!! Form::radio('featured', false, true) !!} no
                </label>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('recommend', 'Recommend:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <label class="radio-inline">
                    {!! Form::radio('recommend', true, false) !!} yes
                </label>
                <label class="radio-inline">
                    {!! Form::radio('recommend', false, true) !!} no
                </label>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Save', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.products.index') }}" role="button">Cancel</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection
