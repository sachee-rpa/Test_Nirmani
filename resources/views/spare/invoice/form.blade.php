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
                    <spare-invoice
                    :customers="{{ $customers }}"
                    :spareparts="{{ $spareparts }}"
                    :customer_pos="{{ $customer_pos }}"
                    :nbt_percentage="{{ $nbt_percentage }}"
                    :vat_percentage="{{ $vat_percentage }}"
                    :customer_types="{{ $customer_types }}"
                    :invoice_types="{{ $invoice_types }}"  
                    @if ($invoice ?? false)
                    :property_update="{{ $invoice }}"
                    @endif
                    ></spare-invoice>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection