@extends('auth.layouts.layout')
@section('content')
<div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
    <div class="app-logo"></div>
    <h4 class="mb-0">
        <span class="d-block">{{ __('Reset Password') }},</span>
        <span>Please add new password.</span></h4>
    <div class="divider row"></div>
    <div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group"><label for="exampleEmail"
                            class="">{{ __('E-Mail Address') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">{{ __('Password') }}</label>

                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="divider row"></div>
            <div class="ml-auto">
                <button type="submit" class="btn btn-primary btn-lg">
                    {{ __('Reset Password') }}
                </button>
            </div>

        </form>
    </div>
</div>
@endsection