@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    @include('layouts.inc.page-title')
    <div class="row"> 
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    
                    @include('layouts.inc.success')
                    <h5 class="card-title">{{ $page_name ?? '' }}</h5>
                    <spare-grn
                    :employeessuppliers="{{ $suppliers }}"
                    :countries="{{ $countries }}"
                    :currencies="{{ $currencies }}"
                    :conditions="{{ $conditions }}"
                    :qualities="{{ $qualities }}"
                    :spareparts="{{ $spareparts }}"
                    :suppliers="{{ $suppliers }}"
                    :units="{{ $units }}"
                    :spare_pos="{{ $spare_pos }}"
                    :selling_percentage="{{ $selling_percentage }}"                    
                    @if ($grn ?? false)
                    :property_update="{{ $grn }}"
                    @endif
                    ></spare-grn>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection