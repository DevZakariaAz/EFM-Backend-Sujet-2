<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rule Engine Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        pre {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1 class="text-center mb-4">Rule Engine Test</h1>

            <div class="mb-3">
                <strong class="text-primary">Product Data:</strong>
                <pre>{{ json_encode($product, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
            </div>

            <div class="mb-3">
                <strong class="text-dark">Rule:</strong> 
                <span class="text-muted">{{ $rule }}</span>
            </div>

            <div class="mb-3">
                <strong class="text-dark">Evaluation Result:</strong> 
                @if($result)
                    <span class="badge badge-success px-3 py-2">True</span>
                @else
                    <span class="badge badge-danger px-3 py-2">False</span>
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>
