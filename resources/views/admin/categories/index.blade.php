<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories - CodeCommerce</title>
</head>
<body>

<h1>Categories</h1>

<table class="table">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
