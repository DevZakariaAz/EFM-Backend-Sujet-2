<div class="container mt-5">
    <h2 class="text-center"> Tableau de Bord</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
             Produits en Alerte
        </div>
        <div class="card-body">
            @if($alertProducts->isEmpty())
                <p>Aucun produit en alerte </p>
            @else
                <ul class="list-group">
                    @foreach($alertProducts as $produit)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $produit->nom }} , Prix: {{ $produit->prix }} €
                            <span class="badge badge-warning">En Alerte</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
