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
                                    <label for="item_name">Item Name</label>
                                    <div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter Item Name"
                                            value="{{ old('name') ? old('name') : $object->name }}" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="brand_id">Brand/Make</label>
                                    <div>
                                        <select id="brand_id" name="brand_id"
                                            class="dynamic mb-2 form-control form-control @error('brand_id') is-invalid @enderror"
                                            data-dependent="brand_model_id" data-route="{{ route('select') }}"
                                            data-hold="Select Model">
                                            <option value="">Select Brand
                                            </option>
                                            @if (!empty($brands))
                                            @foreach ($brands as $brand)
                                            <option @if (old('brand_id')==$brand->id || $object->brand_id == $brand->id
                                                )
                                                selected
                                                @endif value="{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                              

                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group col-lg-12">
                                    <label for="unit_id">Units</label>
                                    <div>
                                        <select id="unit_id" name="unit_id"
                                            class="mb-2 form-control form-control @error('unit_id') is-invalid @enderror"
                                            autofocus>
                                            <option value="">Select Machine Type
                                            </option>
                                            @if (!empty($units))
                                            @foreach ($units as $unit)
                                            <option @if (old('unit_id')==$unit->id || $object->unit_id ==
                                                $unit->id
                                                )
                                                selected
                                                @endif value="{{ $unit->id }}">
                                                {{ $unit->name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('unit_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="market_rate">Market Rate</label>
                                    <div>
                                        <input type="number"
                                            class="form-control @error('market_rate') is-invalid @enderror"
                                            id="market_rate" name="market_rate" placeholder="Enter Market Rate"
                                            value="{{ old('market_rate') ? old('market_rate') : $object->market_rate }}"
                                            autofocus>
                                        @error('market_rate')
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
                                <div class="form-group col-lg-12">
                                    <label for="remark">Remark</label>
                                    <div>
                                        <textarea rows="1" class="form-control autosize-input" name="remark" id="remark"
                                            style="height: 77px;" placeholder="Enter Remarks..."></textarea>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-md-12">
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