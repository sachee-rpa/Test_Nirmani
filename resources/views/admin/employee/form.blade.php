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
                    <form id="signupForm" class="col-md-10 mx-auto" method="post" action="{{ $route }}" enctype="multipart/form-data" >
                        @csrf
                        @if ($update)
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="item_name">Employee Name</label>
                                    <div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter Employee Name"
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
                                    <label for="initial">Name with Initial</label>
                                    <div>
                                        <input type="text" class="form-control @error('initial') is-invalid @enderror"
                                            id="initial" name="initial" placeholder="Enter  Name with Initial"
                                            value="{{ old('initial') ? old('initial') : $object->initial }}" autofocus>
                                        @error('initial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                             

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="nic_number">NIC Number</label>
                                    <div>
                                        <input type="text" class="form-control @error('nic_number') is-invalid @enderror"
                                            id="nic_number" name="nic_number" placeholder="Enter NIC Number"
                                            value="{{ old('nic_number') ? old('nic_number') : $object->nic_number }}" autofocus>
                                        @error('nic_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="employee_category_id">Category</label>
                                <div>
                                    <select id="employee_category_id" name="employee_category_id"
                                        class=" mb-2 form-control form-control @error('employee_category_id') is-invalid @enderror"
                                        autofocus>
                                        <option value="0">Select Employee Category
                                        </option>
                                        @if (!empty($categories))
                                        @foreach ($categories as $category)
                                        <option @if (old('employee_category_id')==$category->id || $object->employee_category_id ==$category->id )
                                            selected
                                            @endif value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                        @endif

                                    </select>
                                    @error('employee_category_id')
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
                                    <label for="designation">Designation</label>
                                    <div>
                                        <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                            id="designation" name="designation" placeholder="Enter Designation"
                                            value="{{ old('designation') ? old('designation') : $object->designation }}" autofocus>
                                        @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="join_date">Joined Date</label></label>
                                    <div>
                                      
                                        <input type="date" class="form-control @error('join_date') is-invalid @enderror"
                                            id="join_date" name="join_date" placeholder="Enter Joined Date"
                                            value="{{ old('join_date') ? old('join_date') : $object->join_date }}" autofocus>
                                        @error('join_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="day_rate">Day Rate (8 hours )</label>
                                    <div>
                                        <input type="number" class="form-control @error('day_rate') is-invalid @enderror"
                                            id="day_rate" name="day_rate" placeholder="Enter Day Rate (8 hours )"
                                            value="{{ old('day_rate') ? old('day_rate') : $object->day_rate }}" autofocus>
                                        @error('day_rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="exampleFile" class="">File</label>
                                    <div>
                                        <input type="file" class="form-control-file @error('upload') is-invalid @enderror"
                                            id="upload" name="upload" placeholder="Enter Day Rate (8 hours )"
                                            value="{{ old('upload') ? old('upload') : $object->upload }}" autofocus>   
                                            @error('upload')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror       
                                            @if ($update && $object->file)
                                        <a class="btn position-relative btn-primary mt-2 " href="{{ $object->fileUrl }}" target="_blank"><i class="fa fa-download"></i> Download</a>
                                        @endif
                                    </div>
                                </div>
                            </div>  
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="ot_rate">OT Rate</label>
                                        <div>
                                            <input type="number" class="form-control @error('day_rate') is-invalid @enderror"
                                                id="ot_rate" name="ot_rate" placeholder="Enter OT Rate"
                                                value="{{ old('ot_rate') ? old('ot_rate') : $object->ot_rate }}" autofocus>
                                            @error('ot_rate')
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
                                <div class="form-group">
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