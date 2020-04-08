@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    @include('layouts.inc.page-title')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    @include('layouts.inc.success')
                    <h5 class="card-title">{{ $page_name }}</h5>
                    <form id="signupForm" class="col-md-10 mx-auto" method="post" action="{{ $route }}">
                        @csrf
                        @if ($update)
                        @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="account">Account</label>
                            <div>
                                <select id="account_id" name="account_id"
                                    class=" mb-2 form-control form-control @error('account_id') is-invalid @enderror"
                                    autofocus>
                                    <option value="0">Select Account
                                    </option>
                                    @if (!empty($accounts))
                                    @foreach ($accounts as $account)
                                    <option @if (old('account_id')==$account->id || $object->account_id == $account->id )
                                        selected
                                        @endif value="{{ $account->id }}">
                                        {{ $account->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('account_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="Enter User Name"
                                    value="{{ old('name') ? old('name') : $object->name }}" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary mt-2 btn-lg" name="signup"
                                value="Sign up">{{ $submit_btn }}</button>
                            @if ($update)
                            @method('PUT')
                            <a href="{{ URL::previous() }}" class="btn btn-warning mt-2 btn-lg">
                                <i class="fa   fa-angle-double-left fa-w-20"></i> Back </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection