@extends('app')

@section('content')

    <div class="container">

        <h3>Orders</h3>

        <div class="text-right">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-default btn-sm">Refresh</a>
        </div>

        <br>

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <th width="5%">Id</th>
            <th width="12%">Date</th>
            <th>User</th>
            <th width="8%">Qtd (Items)</th>
            <th width="8%">Total</th>
            <th width="15%">Status</th>
            <th width="18%">Action</th>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ date('m/d/Y H:i', strtotime($order->created_at)) }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ count($order->items) }}</td>
                    <td>$ {{ number_format($order->total, 2) }}</td>
                    <td>{{ $order->getStatus()  }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" class="btn btn-primary btn-xs">To manage</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $orders->render() !!}

    </div>{{--/container--}}

@endsection
