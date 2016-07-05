@extends('store.store')

@section('content')
    <section id="cart_items">
        <div class="container">
            {!! Form::open(['route' => 'cart.update', 'method' => 'POST', 'id' => 'cart_form']) !!}
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    @if(count($cart->all()))
                        <thead>
                        <tr class="cart_menu">
                            <td class="image"></td>
                            <td class="description">Item</td>
                            <td class="price">Price</td>
                            <td class="price">Quantity</td>
                            <td class="price">Total</td>
                            <td></td>
                        </tr>
                        </thead>
                    @endif
                    <tbody>
                    @forelse($cart->all() as $k => $item)
                        <tr>
                            <td class="cart_product">
                                <a href="{{ route('store.product', ['id' => $k]) }}">
                                    @if(file_exists(public_path('uploads') . '/' . $k . '.jpg'))
                                        <img src="{{ url('uploads/' . $k . '.jpg') }}" width="45" alt=""/>
                                    @else
                                        <img src="{{ url('images/no-img.jpg') }}" width="45" alt=""/>
                                    @endif
                                </a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="{{ route('store.product', ['id' => $k]) }}">{{ $item['name'] }}</a></h4>
                                <p>Code: {{ $k }}</p>
                            </td>
                            <td class="cart_price">
                                $ {{ number_format($item['price'], 2) }}
                            </td>
                            <td class="cart_quantity">
                                <input type="number" name="items[{{ $k }}]" value="{{ $item['qtd'] }}" min="1" max="100">&nbsp;&nbsp;
                                <a href="javascript:;" onclick="document.getElementById('cart_form').submit(); return false;"><span class="glyphicon glyphicon-refresh"></span></a>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$ {{ number_format($item['qtd'] * $item['price'], 2) }}</p>
                            </td>
                            <td class="cart_delete">
                                <a href="{{ route('cart.destroy', ['id' => $k]) }}" class="cart_quantity_delete">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">
                                <h1>Your Shopping Cart is empty. :(</h1>
                            </td>
                        </tr>
                    @endforelse
                    @if(count($cart->all()))
                        <tr class="cart_menu">
                            <td class="text-right" colspan="6">
                                Total: $ {{ number_format($cart->getTotal(), 2) }}&nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="6">
                                <a href="{{ route('checkout.place') }}" class="btn btn-primary">Proceed to checkout</a>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection
