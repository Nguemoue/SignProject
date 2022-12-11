@component('mail::message')
# Salut {{ $notifiable->name }}

Felicitation pour votre commande

Votre commade No {{ $commande->numero }} du {{ $commande->created_at->IsoFormat('lll') }}
est en attente de livraison !


@component("mail::table")

| produit      | Prix unitaire(Euro)  |   Quantite |Prix Total(en Euro)|
|--------------|:-----:|:-------------:|:-----------:|
@foreach ($commande->commandeProduits as $item)
|{{  $item->produit->nom}}|  {{ $item->produit->prix}}|{{ $item->quantite }}|{{ $item->quantite*$item->produit->prix }} |
@endforeach
|sous total|        {{ $commande->prix}}  €       | | |
|taxe (5%)      |         {{ $commande->prixTtc - $commande->prix }} €          | | |
|total     |           **{{ $commande->prixTtc }} €**         | | |
@endcomponent

@component("mail::button",['url'=>config('app.url')])
    visiter le site
@endcomponent


Merci,<br>

{{ config('app.name') }}

@endcomponent
