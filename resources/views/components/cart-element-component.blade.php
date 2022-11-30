@php
    $produitId = 'produit-' . $produit->id;
    $totalProduitId = 'total-' . $produitId;
@endphp
<div>
    <tr>
        <td>
            <div class="media">
                <div class="d-flex">
                    <img src="img/cart/cart1.png" alt="">
                </div>
                <div class="media-body">
                    <p class="text-bold">{{ $produit->nom }}</p>
                </div>
            </div>
        </td>
        <td>
            <h5>$ {{ $produit->prix }}</h5>
        </td>
        <td>
            <div class="product_count">
                <input type="hidden" value="{{ $produit->id }}" name="produitIds[]">
                <input name="produitQuantites[]" data-prix="{{ $produit->prix }}" type="text" id="{{ $produitId }}" class="input-text qty"
                    value="{{ $quantite }}">
                @error('quantite')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </td>
        <td>
            <h5>$ <span id="{{ $totalProduitId }}">{{ $produit->total }}</span> </h5>
        </td>
        <td>
            
            <a href="{{ route('cart.delete', ['produit_id' => $produit->id]) }}"  class="btn btn-danger btn-sm">
                delete
            </a>
            </td>
    </tr>
    <script>
        (function() {
            let input = document.getElementById("{{ $produitId }}");
            let totalProduitItem = document.getElementById("{{ $totalProduitId }}")

            input.addEventListener('keyup', function(event) {
                let val = event.target.value;
                val = parseInt(val);
                if (val) {
                    let produitPrixParsed = parseFloat(event.target.dataset.prix)
                    let res = val * produitPrixParsed;
                    totalProduitItem.innerText = res
                }
            });
        })();
    </script>

</div>
