@extends('templates.default')
@php
    $title = 'Master Role';
    $preTitle = null;
    $currentRouteName = Route::currentRouteName();
@endphp

@section('content')
    @include('master.role.toolbar')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-10">
                <div class="col-xl mb-md-5 mb-xl-10">
                    <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                        @if ($akses->select == 't')
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <table id="dt_index" class="table table-striped table-bordered gy-5 gs-7 rounded mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" width="10%">No.</th>
                                                <th scope="col">Nama Role</th>
                                                <th scope="col" class="text-center" width="10%">Status</th>
                                                @if ($akses->update == 't' || $akses->delete == 't')
                                                    <th scope="col" class="text-center" width="10%">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('master.role.modal')
    @include('master.role.table_akses')

    @push('styles')
        <link href="{{ asset('dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
    @endpush

    @push('scripts')
        <script src="{{ asset('dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @endpush

    @push('scripts')
        <!--Datatable Roles-->
        <script>
            $(document).ready(function() {
                let table = $('#dt_index').DataTable({
                    processing: true,
                    autoWidth: false,
                    serverside: true,
                    responsive: true,
                    language: {
                        lengthMenu: "Show _MENU_",
                    },
                    dom: "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                        ">" +

                        "<'table-responsive'tr>" +

                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">",
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 0
                        },
                        {
                            responsivePriority: 2,
                            targets: -1
                        },
                    ],
                    ajax: "{{ route('roles.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'fs-6 text-center',
                        },
                        {
                            data: 'name',
                            name: 'name',
                            // className: 'fs-6 text-center',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            className: 'fs-6 text-center',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    language: {
                        search: "Cari:",
                        searchPlaceholder: "Cari",
                        lengthMenu: "Tampilkan _MENU_ data",
                        zeroRecords: "Tidak ada data",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        infoFiltered: "(disaring dari _MAX_ total data)",
                        paginate: {
                            /* icon for next */
                            next: '<i class="fas fa-angle-right"></i>',
                            /* icon for previous */
                            previous: '<i class="fas fa-angle-left"></i>'
                        },
                        /* load dist/assets/img/icons/logo-sby.svg inside processing set div for img loading */
                        processing: "<div class='d-flex justify-content-center align-items-center'><img src='{{ asset('dist/assets/media/logos/favicon.ico') }}' class='img-fluid' style='width: 100px; height: 100px;'></div>",
                    },
                });

                window.table = table;
            });
        </script>
        <!--End : Datatable Roles-->

        <!--Datatable Akses Role-->
        <script>
            function roleAkses(route, title) {
                var modal = '#kt_modal_table';
                $(`${modal} .modal-title`).text(title);
                $(modal).modal('show');
                console.log(route, title);

                $(document).ready(function() {
                    let table = $('#table_akses').DataTable({
                        processing: true,
                        autoWidth: false,
                        serverside: true,
                        responsive: true,
                        language: {
                            lengthMenu: "Show _MENU_",
                        },
                        dom: "<'row'" +
                            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                            ">" +

                            "<'table-responsive'tr>" +

                            "<'row'" +
                            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                            ">",
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: 0
                            },
                            {
                                responsivePriority: 2,
                                targets: -1
                            },
                        ],
                        ajax: route,
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false,
                                className: 'fs-6 text-center',
                            },
                            {
                                data: 'menu',
                                name: 'menu',
                                // className: 'fs-6 text-center',
                            },
                            {
                                data: 'select',
                                name: 'select',
                                // className: 'fs-6 text-center',
                            },
                            {
                                data: 'insert',
                                name: 'insert',
                                // className: 'fs-6 text-center',
                            },
                            {
                                data: 'update',
                                name: 'update',
                                // className: 'fs-6 text-center',
                            },
                            {
                                data: 'delete',
                                name: 'delete',
                                // className: 'fs-6 text-center',
                            },
                            // {
                            //     data: 'action',
                            //     name: 'action',
                            //     orderable: false,
                            //     searchable: false
                            // },
                        ],
                        language: {
                            search: "Cari:",
                            searchPlaceholder: "Cari",
                            lengthMenu: "Tampilkan _MENU_ data",
                            zeroRecords: "Tidak ada data",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                            infoFiltered: "(disaring dari _MAX_ total data)",
                            paginate: {
                                /* icon for next */
                                next: '<i class="fas fa-angle-right"></i>',
                                /* icon for previous */
                                previous: '<i class="fas fa-angle-left"></i>'
                            },
                            /* load dist/assets/img/icons/logo-sby.svg inside processing set div for img loading */
                            processing: "<div class='d-flex justify-content-center align-items-center'><img src='{{ asset('dist/assets/media/logos/favicon.ico') }}' class='img-fluid' style='width: 100px; height: 100px;'></div>",
                        },
                        destroy: true,
                    });

                    window.table = table;
                });
            }
        </script>
        <!--End : Datatable Akses Roles-->
        @include('master.role.crud-scripts')
    @endpush
@endsection
