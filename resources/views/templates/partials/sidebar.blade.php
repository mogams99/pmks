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
            @foreach ($access as $key => $value)
                @php
                    $menu = $value->menu;
                    if ($menu) {
                        $subMenus = $menu->sub_menus;
                        $countSubMenus = $subMenus->count();
                        $url = $menu->url;
                        $currentRoute = Route::currentRouteName();
                    } else {
                        // Lakukan sesuatu jika $menu adalah null
                        continue; // Skip iterasi ke iterasi berikutnya
                    }
                @endphp
                @if ($menu->parent_id == null && $countSubMenus <= 0)
                    <div class="menu-item menu-accordion {{ $url == $currentRoute ? 'hover showing' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ $menu->url ? route($menu->url) : '#' }}">
                            <span class="menu-icon"> 
                                <i class="{{ $menu->icon }} fs-2"></i>
                            </span>
                            <span class="menu-title">{{ $menu->name }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @elseif ($menu->parent_id == null && $countSubMenus > 0)
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->segment(1) == $menu->active ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="{{ $menu->icon }} fs-2"></i>
                            </span>
                            <span class="menu-title">{{ $menu->name }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--begin:Menu sub-->
                        @include('templates.partials.submenu', ['subMenus' => $subMenus])
                        <!--end:Menu sub-->
                    </div>
                @endif
            @endforeach
            <!--end:Menu item-->
        </div>
        <!--end::Sidebar menu-->
    </div>
    <!--end::Wrapper-->
</div>
