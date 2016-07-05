@extends('app')

@section('content')

    <div class="container">

        <h3>Order Details</h3>

        <div class="text-right">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-default btn-sm">Back</a>
        </div>

        <br>

        @include('errors._check')

        @if(!empty($order))
            {!! Form::model($order, ['route' => ['admin.orders.update', $order->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
        @endif

        <dl class="dl-horizontal">
            <dt>ID:</dt>
            <dd>{{ $order->id }}</dd>
            <hr>
            <dt>Date:</dt>
            <dd>{{ date('m/d/Y H:i', strtotime($order->created_at)) }}</dd>
            <hr>
            <dt>User:</dt>
            <dd>{{ $order->user->name }}</dd>
            <hr>
            <dt>Items:</dt>
            <dd>
                @foreach($order->items as $item)
                    <p>{{ $item->qtd }} :: {{ $item->product->name }} :: $ {{ number_format($item->price, 2) }}</p>
                @endforeach
            </dd>
            <hr>
            <dt>Qtd (Items):</dt>
            <dd>{{ count($order->items) }}</dd>
            <hr>
            <dt>Total:</dt>
            <dd>$ {{ number_format($order->total, 2) }}</dd>
            <hr>
            <dt>Status:</dt>
            <dd>{!! Form::select('status', $options) !!}</dd>
        </dl>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Save', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.orders.index') }}" role="button">Cancel</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection
