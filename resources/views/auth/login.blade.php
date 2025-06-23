@extends('layouts.app')

@section('content')

    <body class="img js-fullheight">
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h2 class="heading-section">Wallet Manager</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">Admin</h3>
                            <form method="POST" action="{{ route('login') }}" class="signin-form">
                                @csrf

                                <div class="form-group">
                                    <input id="email" type="email" name="email"
                                        class="form-control custom-input @error('email') is-invalid @enderror"
                                        placeholder="Email Address" value="{{ old('email') }}" required
                                        autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert" style="display:block; color:#ff6b6b;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input id="password-field" type="password" name="password"
                                        class="form-control custom-input @error('password') is-invalid @enderror"
                                        placeholder="Password" required autocomplete="current-password">
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="display:block; color:#fefefe;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group d-md-flex">
                                    <div class="w-50">
                                        <label class="checkbox-wrap checkbox-primary">Beni Hatırla
                                            <input type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" style="color: #fff">Şifremi
                                                Unuttum</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-secondary submit px-3">Giriş
                                        Yap</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
@endsection
