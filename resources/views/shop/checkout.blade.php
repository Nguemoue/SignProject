@extends('template')


@section('main')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Product Checkout</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->


    <!--================Checkout Area =================-->
    <section class="checkout_area section-margin--small">
        <div class="container">

            <div class="cupon_area">
                <div class="check_title">
                    <h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>
                </div>
                <input type="text" placeholder="Enter coupon code">
                <a class="button button-coupon" href="#">Apply Coupon</a>
            </div>
            <div class="billing_details">
                <form action="{{ route('shop.confirmation.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7">
                            <h3>Billing Details</h3>
                            @php
                                $user = auth()->user();
                            @endphp
                            <div class="row">
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" readonly value="{{ $user->name }}" class="form-control"
                                        id="first" name="name">
                                    <span class="placeholder" data-placeholder="First name"></span>
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" readonly value="{{ $user->email }}" class="form-control"
                                        id="last" name="name">
                                    <span class="placeholder" data-placeholder="Last name"></span>
                                </div>
                            </div>
                            {{-- telephone --}}
                            <div class="row">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" value="{{ $user->telephone }}"
                                        id="number" readonly name="number" placeholder="numero de telephone">
                                </div>
                            </div>


                            <h3>Adress Details</h3>
                            @php
                                $adresse = $user->adresse;
                            @endphp
                            <div class="row">
                                <div class="col-md-12 form-group p_star">
                                    <label for="">Pays</label>
                                    <select class="w-100" name="pays" required>
                                        @foreach ($pays = ['cameroun', 'algerie'] as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col-md-12 form-group p_star">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" value="{{ $adresse->quartier . ''.$adresse->numeroRue }}" class="form-control" required name="adresse" id="adresse" name="adresse">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group p_star">
                                <label for="city">Ville</label>
                                <input type="text" value="{{ $adresse->ville }}" class="form-control" id="city" required name="ville">
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group p_star">
                                    <label for="">District</label>
                                <input placeholder="district" value="{{ $adresse->district }}" type="text" required class="form-control" id="city" name="district">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Zip</label>
                                <input type="text" class="form-control" id="zip" value="{{ $adresse->zip }}" name="zip" required placeholder="Postcode/ZIP">
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li><a href="#">
                                            <h4>Product <span>Total</span></h4>
                                        </a></li>
                                    @php($count = 0)
                                    @foreach ($produits as $produit)
                                        @php($count = $produit->total + $count)
                                        <li><a href="#">{{ $produit->nom }} <span class="middle">x
                                                    {{ $produit->nombre }}</span> <span class="last">$
                                                    {{ $produit->total }}</span></a></li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li><a href="#">Subtotal <span>${{ $count }}</span></a></li>
                                    <li><a href="#">Shipping <span>Flat rate: $00.00</span></a></li>
                                    <li><a href="#">Total <span>${{ $count }}</span></a></li>
                                </ul>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input required type="radio" id="f-option6" name="accept">
                                        <label for="f-option6">Paypal </label>
                                        <img src="{{ asset('img/product/card.jpg') }}" alt="">
                                        <div class="check"></div>
                                    </div>
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                        account.</p>
                                </div>
                                <div class="creat_account">
                                    <input required type="checkbox" id="f-option4" name="terms">
                                    <label for="f-option4">I’ve read and accept the </label>
                                    <a href="#">terms & conditions*</a>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="button button-paypal" href="#">Proceed to Paypal</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection
