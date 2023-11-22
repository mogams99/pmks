<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
        data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
            class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                @foreach ($access as $key => $value)
                    @php
                        $menu = $value->menu;
                        $menu_arrays = $menu->toArray();
                        $submenu_arrays = $menu->sub_menus()->get();
                        $current_route = request()->route()->getName();
                        $is_show = '';

                        if ($menu_arrays['parent_id'] === null) {
                            if ($current_route === $menu_arrays['url']) {
                                $is_show = 'show';
                            }

                            foreach ($submenu_arrays as $submenu) {
                            $separate = strstr($submenu->url, '.', true);
                            $submenu_active = $separate.'*';
                                if (request()->is($submenu_active)) {
                                    $is_show = 'show';
                                    break;
                                }
                            }
                        }
                    @endphp
                    
                    @if ($menu_arrays['parent_id'] === null)
                        @if ($submenu_arrays->count() > 0)
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="fonticon-stats fs-2"></i>
                                </span>
                                <span class="menu-title">{{ $menu_arrays['name'] }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            @foreach ($submenu_arrays as $submenu)
                            @php
                                $separate = strstr($submenu->url, '.', true);
                                $submenu_active = $separate.'*';
                            @endphp
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is($submenu_active) ? 'active' : '' }}" href="{{ route($submenu->url) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">User</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <!--begin:Menu item-->
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->is($menu_arrays['url']) ? 'active' : '' }}" href="{{ route($menu_arrays['url']) }}">
                                <span class="menu-icon">
                                    <i class="{{ $menu_arrays['icon'] }} fs-2"></i>
                                </span>
                                <span class="menu-title">{{ $menu_arrays['name'] }}</span>
                            </a>
                            <!--end:Menu link-->
                            <!--end:Menu item-->
                        @endif
                    @endif
                @endforeach
            </div>
            <!--end:Menu item-->
        </div>
        <!--end::Sidebar menu-->
    </div>
    <!--end::Wrapper-->
</div>