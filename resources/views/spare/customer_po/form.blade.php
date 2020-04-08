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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-lg-12">
                                    <label for="name">PO Number</label>
                                    <div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                            name="name" placeholder="Enter PO Number"
                                            value="{{ old('name') ? old('name') : $object->name }}" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                            <label for="customers_id">Customers</label>
                            <div>
                                <select id="customers_id" name="customers_id"
                                    class="mb-2 form-control form-control @error('customers_id') is-invalid @enderror"
                                    autofocus>
                                    <option value="">Select Customers
                                    </option>
                                    @if (!empty($customers))
                                    @foreach ($customers as $customer)
                                    <option @if (old('customers_id')==$customer->id || $object->customers_id ==
                                        $customer->id
                                        )
                                        selected
                                        @endif value="{{ $customer->id }}">
                                        {{ $customer->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('customers_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                        </div>
                        <div class="row">
                          
                        <div class="form-group col-lg-12 ">
                            <button type="submit" class="btn btn-primary mt-2 btn-lg" name="signup"
                                value="Sign up">{{ $submit_btn }}</button>
                            @if ($update)
                            @method('PUT')
                            <a href="{{ URL::previous() }}" class="btn btn-warning mt-2 btn-lg">
                                <i class="fa   fa-angle-double-left fa-w-20"></i> Back </a>
                            @endif
                        </div>
                       
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection