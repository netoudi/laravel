@extends('store.store')

@section('categories')
    @include('store.partial.account')
@endsection

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Your Orders</h2>
            <section id="cart_items">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed table-striped">
                        <thead>
                        <tr class="cart_menu text-center">
                            <td>#Id</td>
                            <td>Date</td>
                            <td>Items</td>
                            <td>Qtd (Item)</td>
                            <td>Total</td>
                            <td>Status</td>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr class="text-center">
                                <td>
                                    {{ $order->id }}
                                </td>
                                <td>
                                    {{ date('F d, Y', strtotime($order->created_at)) }}
                                </td>
                                <td>
                                    <ul>
                                        @foreach($order->items as $item)
                                            <li>{{ $item->product->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    {{ count($order->items) }}
                                </td>
                                <td>
                                    $ {{ number_format($order->total, 2) }}
                                </td>
                                <td>
                                    {{ $order->status }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="6">
                                    <h1>No order made yet. :(</h1>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div><!--features_items-->
    </div>
@endsection
