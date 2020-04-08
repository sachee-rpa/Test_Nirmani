<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="{{ $main_icon }} icon-gradient bg-tempting-azure">
                </i>
            </div>
            <div>{{ $page_name ?? '' }}
                <div class="page-title-subheading">
                    {{ $page_desc ?? '' }}
                </div>
            </div>

        </div>
        <div class="page-title-actions">
            <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button>
            <div class="d-inline-block dropdown">
                <a href="{{ $btn_route }}" type="button" class="btn-shadow  btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa   {{ $btn_icon }} fa-w-20"></i>
                    </span>
                  
                </a>
            </div>
        </div>
    </div>
</div>