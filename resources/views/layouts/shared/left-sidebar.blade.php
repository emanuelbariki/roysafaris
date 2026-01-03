<div class="left-sidenav">
    <div class="brand">
        <a href="{{ route('dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
            </span>

            <span>
                <img src="{{ asset('assets/images/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>


    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            @foreach($sidebarMenu as $item)
                @if(isset($item['is_label']) && $item['is_label'])
                    <li class="menu-label mt-0">{{ $item['label'] }}</li>
                @elseif(isset($item['is_dropdown']) && $item['is_dropdown'])
                    <li>
                        <a href="javascript: void(0);"
                           class="{{ request()->routeIs($item['active_routes'] ?? []) ? 'active' : null }}">
                            <i data-feather="{{ $item['icon'] }}" class="align-self-center menu-icon"></i>
                            <span>{{ $item['name'] }}</span>
                            <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                        </a>

                        <ul class="nav-second-level" aria-expanded="false">
                            @foreach($item['children'] as $child)
                                <li class="nav-item {{ request()->routeIs($child['active_routes'] ?? []) ? 'active' : null }}">
                                    <a class="nav-link {{ request()->routeIs($child['active_routes'] ?? []) ? 'active' : null }}"
                                       href="{{ route($child['route']) }}">
                                        <i class="{{ $child['icon'] }}"></i>{{ $child['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="{{ request()->routeIs($item['active_routes'] ?? []) ? 'active' : null }}">
                            <i data-feather="{{ $item['icon'] }}" class="align-self-center menu-icon"></i>
                            <span>{{ $item['name'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
