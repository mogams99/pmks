<div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                    {{ $title }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route($currentRouteName) }}"
                            class="text-muted text-hover-primary">{{ $title }}</a>
                    </li>
                    @if ($preTitle != null)
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ $preTitle }}</li>
                    @endif
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if ($akses->insert == 't')
                    <button onclick="addForm(`{{ route('user.store') }}`, 'Tambah Role')"
                        class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal"
                        data-bs-toggle="modal" data-bs-target="#kt_modal_1">Tambah Data</button>
                @endif
            </div>
        </div>
    </div>
</div>
