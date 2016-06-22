<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - CodeCommerce</title>
</head>
<body>

<h1>Products</h1>

<table class="table">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->description }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
