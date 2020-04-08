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
                                    <label for="item_name">Supplier Name</label>
                                    <div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter Supplier Name"
                                            value="{{ old('name') ? old('name') : $object->name }}" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="address">Address</label>
                                    <div>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" placeholder="Enter  Address"
                                            value="{{ old('address') ? old('address') : $object->address }}" autofocus>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <stron-g>{{ $message }}</stron-g>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="country_id">Country</label>
                                    <div>
                                        <select id="country_id" name="country_id"
                                            class=" mb-2 form-control form-control @error('country_id') is-invalid @enderror"
                                            autofocus>
                                            <option value="0">Select Country
                                            </option>
                                            @if (!empty($countries))
                                            @foreach ($countries as $country)
                                            <option @if (old('country_id')==$country->id || $object->country_id ==
                                                $country->id )
                                                selected
                                                @endif value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                            @endforeach
                                            @endif

                                        </select>
                                        @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-lg-12">
                                    <label for="credit_limit">Credit Limit</label>
                                    <div>
                                        <input type="number"
                                            class="form-control @error('credit_limit') is-invalid @enderror"
                                            id="credit_limit" name="credit_limit" placeholder="Enter Credit Limit"
                                            value="{{ old('credit_limit') ? old('credit_limit') : $object->credit_limit }}"
                                            autofocus>
                                        @error('credit_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="credit_period">Credit Period</label>
                                    <div>
                                        <input type="number"
                                            class="form-control @error('credit_period') is-invalid @enderror"
                                            id="credit_period" name="credit_period" placeholder="Enter Credit Period"
                                            value="{{ old('credit_period') ? old('credit_period') : $object->credit_period }}"
                                            autofocus>
                                        @error('credit_period')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <h6 class="ml-4">Contact Details</h6>
                        </div>
                        <div class="row">

                            <div class="form-group col-lg-3 ml-3">
                                <label for="fixed_line">Fixed Line</label>
                                <div>
                                    <input type="text" class="form-control @error('fixed_line') is-invalid @enderror"
                                        id="fixed_line" name="fixed_line" placeholder="Enter Fixed Line"
                                        value="{{ old('fixed_line') ? old('fixed_line') : $object->fixed_line }}"
                                        autofocus>
                                    @error('fixed_line')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="mobile">Mobile</label>
                                <div>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                        id="mobile" name="mobile" placeholder="Enter Mobile"
                                        value="{{ old('mobile') ? old('mobile') : $object->mobile }}" autofocus>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="fax">Fax</label>
                                <div>
                                    <input type="text" class="form-control @error('fax') is-invalid @enderror" id="fax"
                                        name="fax" placeholder="Enter Fax"
                                        value="{{ old('fax') ? old('fax') : $object->fax }}" autofocus>
                                    @error('fax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="email">Email</label>
                                <div>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Enter Email"
                                        value="{{ old('email') ? old('email') : $object->email }}" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-lg-12">
                                    <label for="vat">VAT</label>
                                    <div>
                                        <input type="number" class="form-control @error('vat') is-invalid @enderror"
                                            id="vat" name="vat" placeholder="Enter VAT"
                                            value="{{ old('vat') ? old('vat') : $object->vat }}" autofocus>
                                        @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-lg-12">
                                    <label for="number">SVAT</label></label>
                                    <div>
                                        <input type="text" class="form-control @error('svat') is-invalid @enderror"
                                            id="svat" name="svat" placeholder="Enter SVAT"
                                            value="{{ old('svat') ? old('svat') : $object->svat }}" autofocus>
                                        @error('svat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <div class="form-group col-lg-12">
                                    <label for="remark">Remark</label>
                                    <div>
                                        <textarea rows="1" class="form-control @error('remark') is-invalid @enderror"
                                            name="remark" id="remark" placeholder="Enter Remark" style="height: 77px;"
                                            value="{{ old('remark') ? old('remark') : $object->remark }}"
                                            autofocus></textarea>
                                    </div>
                                </div> --}}

                                <div class="form-group col-lg-12">
                                    <label for="remark">remark</label>
                                    <div>
                    
                                        <textarea rows="1" class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark"
                                                  placeholder="Enter remark"  style="height: 77px;" value="">{{ old('remark') ? old('remark') : $object->remark  ?? '' }}</textarea>
                                        @error('remark')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn position-relative btn-primary mt-2 btn-lg" name="signup"
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