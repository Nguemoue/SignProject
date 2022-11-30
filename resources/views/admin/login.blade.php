@extends('template')


@section('main')
    <!--================Login Box Area =================-->
    <section class="login_box_area ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Nouveau sur notre Site?</h4>
                            <p>

                            </p>
                            <a class="button button-account" href="{{ route('register') }}">Creer son Compte</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>
                        <div class="container">
                            @includeIf("_partials.errors")
                        </div>
                        <form class="row login_form" action="{{ route('admin.register') }}" id="contactForm" method="POST">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" required class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Entrez votre Email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" required class="form-control" id="password" name="password"
                                    placeholder="Password"  onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="button button-login w-100">Log In</button>
                                <a href="#">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->
@endsection
