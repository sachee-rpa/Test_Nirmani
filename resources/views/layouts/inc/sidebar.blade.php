<div class="app-sidebar sidebar-shadow">
    @includeWhen(true, 'layouts.inc.sidebar.logo')
    @includeWhen(true, 'layouts.inc.sidebar.mobile-menu')
    @includeWhen(true, 'layouts.inc.sidebar.menu')
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">

                @foreach ($sidebars as $sidebar)

                <li class="app-sidebar__heading @if ($sidebar['active'] == true) mm-active @endif">
                    {{ $sidebar['name'] }}</li>
                @foreach ($sidebar['subs'] as $main)

                @if(empty($main['subs']) )
                @if ( $main['name'] != "" )
                <li>

                    <a href="{{ route($main['route_name'] , ['id' => 1]) }}"
                        class="@if ( $main['active'] == true) mm-active @endif">
                        <i class="metismenu-icon {{ $main['icon'] }} ">
                        </i>{{ $main['name'] }}
                    </a>
                </li>
                @endif
                @else
                <li class="@if ($main['active'] == true) mm-active @endif">

                    <a href="#">
                        <i class="metismenu-icon  {{ $main['icon'] }} "></i>
                        {{ $main['name'] }}
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @foreach ( $main['subs'] as $sub)
                        <li>
                            <a href="{{ route($sub['route_name']) }}"
                                class="@if ($sub['active'] == true) mm-active @endif">
                                <i class="metismenu-icon">
                                </i>{{ $sub['name'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>