<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Show</title>
</head>
<body>
    <div>
        <h1>Product Show</h1>
        {{ $product['description'] }} and this price is  {{ $product['price'] }}</div>
        <a href="{{ route('products.index') }}">Back</a>
    </div>
</body>
</html>
