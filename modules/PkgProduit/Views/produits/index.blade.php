<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produits</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center">Gestion des Produits</h2>
    <button class="btn btn-info mb-3" data-toggle="modal" data-target="#addProductModal">+ Ajouter un Produit</button>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Stock</th>
                <th>Prix</th>
                <th>Créé le</th>
                <th>Règle</th> <!-- Nouvelle colonne pour la règle -->
            </tr>
        </thead>
        <tbody id="productTable">
            @foreach ($produits as $Produit)
                <tr>
                    <td>{{ $Produit->id }}</td>
                    <td>{{ $Produit->nom }}</td>
                    <td>{{ $Produit->stock }}</td>
                    <td>{{ $Produit->prix }} €</td>
                    <td>{{ $Produit->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @php
                            $alert = $alertProducts->firstWhere('produit_id', $Produit->id);    
                        @endphp

                        @if($alert && $alert->rule)
                            {{ $alert->rule->label }}
                        @else
                            Rule 2
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $produits->links() }}
    </div>
</div>

<!-- Modal Ajout Produit -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                        <small class="text-danger" id="error-nom"></small>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                        <small class="text-danger" id="error-stock"></small>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="number" class="form-control" id="prix" name="prix" required>
                        <small class="text-danger" id="error-prix"></small>
                    </div>
                    <button type="submit" class="btn btn-info">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#productForm').on('submit', function(e) {
        e.preventDefault();
        $('.text-danger').text('');
        
        $.ajax({
            url: "{{ route('produits.store') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert(response.message);
                location.reload(); // Rafraîchir la page pour voir le nouveau produit
            },
            error: function(xhr) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $('#error-' + key).text(value[0]);
                });
            }
        });
    });
});
</script>
</body>
</html>
