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
                    <spare-gin                                      
                        
                    :invoices="{{ $invoices }}"                  
                    @if ($grn ?? false)
                    :property_update="{{ $grn }}"
                    @endif
                    ></spare-gin>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection