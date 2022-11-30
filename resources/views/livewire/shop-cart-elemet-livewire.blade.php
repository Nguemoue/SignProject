<div>
    <tr>
        <td>
            <div class="media">
                <div class="d-flex">
                    <img src="img/cart/cart1.png" alt="">
                </div>
                <div class="media-body">
                    <p>{{ $produit->nom }}</p>
                </div>
            </div>
        </td>
        <td>
            <h5>$ {{ $produit->prix }}</h5>
        </td>
        <td>
            <div class="product_count">
                <input type="number"  wire:model='quant' class="input-text qty" wire:change='changePrice'>
                @error('quantite')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </td>
        <td>
            <h5>$ {{ $produit->total }} </h5>
        </td>
    </tr>
</div>
