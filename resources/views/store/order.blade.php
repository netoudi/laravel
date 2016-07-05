@extends('store.store')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <caption><h1 class="text-left">#{{ str_pad($order->id, 4, 0, STR_PAD_LEFT) }} order completed!</h1></caption>
                    <thead>
                    <tr class="cart_menu">
                        <td class="image"></td>
                        <td class="description">Item</td>
                        <td class="price">Price</td>
                        <td class="price">Quantity</td>
                        <td class="price">Total</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($order->items as $item)
                        <tr>
                            <td class="cart_product">
                                <a href="{{ route('store.product', ['id' => $item->product->id]) }}">
                                    @if(file_exists(public_path('uploads') . '/' . $item->product->images()->first()->id . '.' . $item->product->images()->first()->extension))
                                        <img src="{{ url('uploads/' . $item->product->images()->first()->id . '.' . $item->product->images()->first()->extension) }}" width="45" alt=""/>
                                    @else
                                        <img src="{{ url('images/no-img.jpg') }}" width="45" alt=""/>
                                    @endif
                                </a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="{{ route('store.product', ['id' => $item->product->id]) }}">{{ $item->product->name }}</a></h4>
                                <p>Code: {{ $item->product->id }}</p>
                            </td>
                            <td class="cart_price">
                                $ {{ number_format($item->price, 2) }}
                            </td>
                            <td class="cart_quantity">
                                {{ $item->qtd }}
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$ {{ number_format($item->qtd * $item->price, 2) }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">
                                <h1>Your Shopping Cart is empty. :(</h1>
                            </td>
                        </tr>
                    @endforelse
                    @if(count($order->items))
                        <tr class="cart_menu">
                            <td class="text-right" colspan="6">
                                Total: $ {{ number_format($order->total, 2) }}&nbsp;&nbsp;
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
