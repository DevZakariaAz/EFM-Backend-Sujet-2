<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rule Engine Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Rule Engine Test</h1>
    <div class="mb-3">
        <strong>Product Data:</strong> {{ json_encode($product) }}
    </div>
    <div class="mb-3">
        <strong>Rule:</strong> {{ $rule }}
    </div>
    <div class="mb-3">
        <strong>Evaluation Result:</strong>
        @if($result)
            <span class="text-success">True</span>
        @else
            <span class="text-danger">False</span>
        @endif
    </div>
</div>
</body>
</html>
