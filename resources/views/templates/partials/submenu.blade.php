<!-- Di dalam partials/submenu.blade.php -->
<div class="menu-sub menu-sub-accordion">
    @foreach ($subMenus as $subMenu)
        @if ($subMenu->sub_menus()->count() > 0)
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ $subMenu->name }}</span>
                    <span class="menu-arrow"></span>
                </span>
                <!-- Jika submenu memiliki submenu, panggil rekursi -->
                @include('templates.partials.submenu', ['subMenus' => $subMenu->sub_menus()->get()])
            </div>
        @else
            <div class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->segment(2) == $subMenu->active ? 'active' : '' }}"
                    href="{{ route($subMenu->url) }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ $subMenu->name }}</span>
                </a>
                <!--end:Menu link-->
            </div>
        @endif
    @endforeach
</div>
