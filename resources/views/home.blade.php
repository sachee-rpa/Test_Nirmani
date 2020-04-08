@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-plane icon-gradient bg-tempting-azure">
                    </i>
                </div>
                <div>DashBoard
                    <div class="page-title-subheading">Wide selection of buttons that feature different
                        styles for backgrounds, borders and hover options!
                    </div>
                </div>
            </div>
            @includeWhen(false, 'layouts.inc.tittle_actions')
        </div>
    </div>

</div>
@endsection