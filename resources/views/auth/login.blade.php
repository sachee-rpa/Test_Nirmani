@extends('auth.layouts.layout')
@section('content')
<div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
    <div class="app-logo"></div>
    <h4 class="mb-0">
        <span class="d-block">Welcome back,</span>
        <span>Please sign in to your account.</span></h4>

    <div class="divider row"></div>
    <div>


        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group"><label for="exampleEmail"
                            class="">{{ __('E-Mail Address') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">{{ __('Password') }}</label>

                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="position-relative form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label for="exampleCheck" class="form-check-label">{{ __('Remember Me') }}</label></div>
            <div class="divider row"></div>
            <div class="d-flex align-items-center">
                <div class="ml-auto">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link btn-lg" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Login to Dashboard') }}
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection