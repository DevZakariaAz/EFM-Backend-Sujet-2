<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products in Alert</div>
                <div class="card-body">
                    @if ($alertProducts->isEmpty())
                        <p>No products in alert.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($alertProducts as $product)
                                <li class="list-group-item">
                                    {{ $product->nom }} (Stock: {{ $product->stock }}, Price: {{ $product->prix }})
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>