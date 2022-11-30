@extends("template")

@section("main")

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Order Confirmation</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Order Details Area =================-->
  <section class="order_details section-margin--small">
    <div class="container">
      <p class="text-center billing-alert">Thank you. Your order has been received.</p>
      @if (!$commande->isValidated)
          <div class="alert alert-warning">
              Votre commande numero <b>{{ $commande->numero }}</b> est en attente de livraison
          </div>
      @endif
      <div class="row mb-5">
        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Order Info</h3>
            <table class="order-rable">
              <tr>
                <td>Order number </td>
                <td > {{ $commande->id }} </td>
              </tr>
              <tr>
                <td>Date</td>
                <td>: {{ $commande->created_at->IsoFormat('lll') }}</td>
              </tr>
              <tr>
                <td>Total</td>
                <td>: USD {{ $commande->prix }}</td>
              </tr>
              <tr>
                <td>Payment method</td>
                <td>: Check payments</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Billing Address</h3>
            @php
              $adresse = auth()->user()->adresse
            @endphp
            <table class="order-rable">
              <tr>
                <td>Street</td>
                <td>: {{ $adresse->quartier }}</td>
              </tr>
              <tr>
                <td>City</td>
                <td>: {{ $adresse->ville }}</td>
              </tr>
              <tr>
                <td>Country</td>
                <td>: {{ $adresse->pays }}</td>
              </tr>
              <tr>
                <td>Postcode</td>
                <td>: {{$adresse->zip }}<td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Shipping Address</h3>
            <table class="order-rable">
              <tr>
                <td>Street</td>
                <td>: 56/8 panthapath</td>
              </tr>
              <tr>
                <td>City</td>
                <td>: Dhaka</td>
              </tr>
              <tr>
                <td>Country</td>
                <td>: Bangladesh</td>
              </tr>
              <tr>
                <td>Postcode</td>
                <td>: 1205</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="order_details_table">
        <h2>Order Details</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($commande->commandeProduits as $item)
                  
              <tr>
                <td>
                  <p>{{ $item->produit->nom }}</p>
                </td>
                <td>
                  <h5>x {{ $item->quantite }}</h5>
                </td>
                <td>
                  <p>$ {{ $item->quantite * $item->produit->prix }}</p>
                </td>
              </tr>
              @endforeach
              
              <tr>
                <td>
                  <h4>Shipping</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <p>Flat rate: $ {{ TaxeCalculator::get($commande->prix) }}</p>
                </td>
              </tr>
              <tr>
                <td>
                  <h4>Total</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <h4>$ {{ $commande->prix }}</h4>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!--================End Order Details Area =================-->
@endsection