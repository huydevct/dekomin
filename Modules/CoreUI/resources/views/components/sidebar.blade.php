<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="/modules/coreui/assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="/modules/coreui/assets/brand/coreui.svg#signet"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.analytic.get') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-speedometer"></x-coreui::vendors.icon>--}}
{{--                Analytics--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.suggest_instructions.list') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-notes"></x-coreui::vendors.icon>--}}
{{--                Suggest Instructions--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.channels.get') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-people"></x-coreui::vendors.icon>--}}
{{--                Channels--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.devices.get') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-devices"></x-coreui::vendors.icon>--}}
{{--                Devices--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="{!! route('admin.categories.get') !!}">
                <x-coreui::vendors.icon name="cil-tags"></x-coreui::vendors.icon>
                Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{!! route('admin.products.list') !!}">
                <x-coreui::vendors.icon name="cil-cart"></x-coreui::vendors.icon>
                Products
            </a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.threads.get') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-loop-1"></x-coreui::vendors.icon>--}}
{{--                Threads--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.runs.get') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-running"></x-coreui::vendors.icon>--}}
{{--                Runs--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.messages.get') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-send"></x-coreui::vendors.icon>--}}
{{--                Messages--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{!! route('admin.daily_images.list') !!}">--}}
{{--                <x-coreui::vendors.icon name="cil-image"></x-coreui::vendors.icon>--}}
{{--                Daily Images--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="{!! route('logout') !!}">
                <x-coreui::vendors.icon name="cil-account-logout"></x-coreui::vendors.icon>
                Đăng xuất
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
