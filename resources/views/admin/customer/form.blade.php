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
                                <div class="form-group ">
                                    <label for="item_name">Name</label>
                                    <div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter Customer Name"
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
                                <div class="form-group ">
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
                             

                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <h5 class="card-title al">Contact Details</h5>
                        </div>
                        <div class="row">

                            <div class="form-group col-lg-3">
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
                            <div class="form-group col-lg-3">
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
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
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
                        <div class="divider"></div>
                     
                        <div class="row">
                            <h5 class="card-title al">Credit Details</h5>
                            
                        </div>
                        <div class="row">
                             <div class="form-group col-lg-3">
                                <div class="custom-checkbox custom-control custom-control-inline">
                                    <input type="checkbox" @if (old('credit')==1 || $object->credit == 1 ) checked @endif name="credit"
                                    id="credit"
                                    class="custom-control-input " value="1">
                                    <label class="custom-control-label" for="credit">Credit Approve</label>
                                </div>
                             </div>
                        </div>
                        <div class="row">
 
                            <div class="form-group col-lg-3">
                                <label for="spare">Spare Parts</label>
                                <div>
                                    <input type="text" class="form-control @error('spare') is-invalid @enderror"
                                        id="spare" name="spare" placeholder="Spare Credit"
                                        value="{{ old('spare') ? old('spare') : $object->spare }}" autofocus>
                                    @error('spare')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="machinery">Machinery</label>
                                <div>
                                    <input type="text" class="form-control @error('machinery') is-invalid @enderror" id="machinery"
                                        name="machinery" placeholder="Machinery Credit"
                                        value="{{ old('machinery') ? old('machinery') : $object->machinery }}" autofocus>
                                    @error('machinery')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="service">Service</label>
                                <div>
                                    <input type="service" class="form-control @error('service') is-invalid @enderror"
                                        id="service" name="service" placeholder="Service Credit"
                                        value="{{ old('service') ? old('service') : $object->service }}" autofocus>
                                    @error('service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="card-title al">Discount Details</h5>                            
                        </div>
                      
                        <div class="row">
 
                            <div class="form-group col-lg-3">
                                <label for="discount_spare">Spare Parts</label>
                                <div>
                                    <input type="text" class="form-control @error('discount_spare') is-invalid @enderror"
                                        id="discount_spare" name="discount_spare" placeholder="Spare Discount"
                                        value="{{ old('discount_spare') ? old('discount_spare') : $object->discount_spare }}" autofocus>
                                    @error('discount_spare')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="discount_machinery">Machinery</label>
                                <div>
                                    <input type="text" class="form-control @error('discount_machinery') is-invalid @enderror" id="discount_machinery"
                                        name="discount_machinery" placeholder="Machinery Discount"
                                        value="{{ old('discount_machinery') ? old('discount_machinery') : $object->discount_machinery }}" autofocus>
                                    @error('discount_machinery')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="service">Service</label>
                                <div>
                                    <input type="discount_service" class="form-control @error('discount_service') is-invalid @enderror"
                                        id="discount_service" name="discount_service" placeholder="Service Discount"
                                        value="{{ old('discount_service') ? old('discount_service') : $object->discount_service }}" autofocus>
                                    @error('discount_service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
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
                                <div class="form-group ">
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
                            {{-- <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="remark">Remark</label>
                                    <div>
                                        <textarea rows="1" class="form-control @error('remark') is-invalid @enderror"
                                            name="remark" id="remark" placeholder="Enter Remark" style="height: 77px;"
                                            value="{{ old('remark') ? old('remark') : $object->remark }}"
                                            autofocus></textarea>
                                    </div>
                                </div>
                            </div> --}}

                            
                            <div class="col-md-12">
                                <div class="form-group ">
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