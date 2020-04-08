@extends('auth.layouts.layout')
@section('content')
<div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
    <div class="app-logo"></div>
    <h4 class="mb-0">
        <span class="d-block ">{{ __('Reset Password') }},</span>
        <span>Use the form below to recover it.</span></h4>

    <div class="divider row"></div>
    <div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group"><label for="exampleEmail"
                            class="">{{ __('E-Mail Address') }}</label>
                        <input name="email" id="exampleEmail" placeholder="Email here..." type="email"
                            class="form-control @error('email') is-invalid @enderror" required autocomplete="email"
                            value="{{ old('email') }}" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="divider row"></div>
            <div class="d-flex align-items-center">
                <div class="ml-auto">

                    <a class="btn btn-link btn-lg" href="{{ route('login') }}">
                        {{ __('Login again ? ') }}
                    </a>
                    <button type="submit" class="btn btn-primary  btn-lg">
                        {{ __('Send Password Reset Link') }}
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection