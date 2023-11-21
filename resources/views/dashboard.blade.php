@extends('templates.default')
@php
    $title = 'Dashboard';
    $preTitle = 'Dashboard';
    $currentRouteName = Route::currentRouteName();
@endphp

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::Row-->
                <!--begin::Statistics Widget 2-->
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body d-flex align-items-center pt-3 pb-0">
                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-13 me-2">
                            <a href="#" class="fw-bold text-dark fs-4 mb-2 text-hover-primary">Halo, Mochammad Gamal!</a>
                            <span class="fw-semibold text-muted fs-5">Admin</span>
                        </div>
                        <img src="dist/assets/media/svg/avatars/029-boy-11.svg" alt="" class="align-self-end h-100px" />
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>
@endsection