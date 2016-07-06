<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pedido realizado com sucesso!</title>
    <style type="text/css">
        table {
            font-family: Arial, sans-serif;
            max-width: 800px;
        }

        table > tbody > tr > td {
            border-bottom: 1px solid #cccccc;
        }

        table > tbody > tr:last-child > td {
            border-bottom: 0;
        }

        h4, p {
            margin: 0;
        }

        a, a:hover, a:visited {
            color: #000;
        }

        .title {
            color: #ffffff;
            background-color: #2e6da4;
            height: 40px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
@if(count($order->items))
    <table align="center" width="98%" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <td colspan="5">
                <h3>Pedido realizado com sucesso!</h3>
                <p>O seu pedido #{{ $order->id }}, foi realizado com sucesso.</p>
            </td>
        </tr>
        <tr class="title">
            <td></td>
            <td>Item</td>
            <td class="text-center">Price</td>
            <td class="text-center">Quantity</td>
            <td class="text-center">Total</td>
        </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td width="5%">
                    <a href="{{ route('store.product', ['id' => $item->product->id]) }}" target="_blank">
                        @if(file_exists(public_path('uploads') . '/' . $item->product->images()->first()->id . '.' . $item->product->images()->first()->extension))
                            <img src="{{ url('uploads/' . $item->product->images()->first()->id . '.' . $item->product->images()->first()->extension) }}" width="45" alt=""/>
                        @else
                            <img src="{{ url('images/no-img.jpg') }}" width="45" alt=""/>
                        @endif
                    </a>
                </td>
                <td>
                    <h4><a href="{{ route('store.product', ['id' => $item->product->id]) }}" target="_blank">{{ $item->product->name }}</a></h4>
                    <p>Code: {{ $item->product->id }}</p>
                </td>
                <td class="text-center">
                    $ {{ number_format($item->price, 2) }}
                </td>
                <td class="text-center">
                    {{ $item->qtd }}
                </td>
                <td class="text-center">
                    $ {{ number_format($item->qtd * $item->price, 2) }}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfooter>
            <tr class="title">
                <td colspan="5" class="text-center">
                    TOTAL: $ {{ number_format($order->total, 2) }}&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <hr>
                    <h4>Obrigado por comprar conosco!</h4>
                    <p>Obs.: Não responda este e-email, ele é gerado automaticamente. Mais informações acesse <a href="{{ url('/') }}" target="_blank">CodeCommerce</a>.</p>
                </td>
            </tr>
        </tfooter>
    </table>
@endif
</body>
</html>
