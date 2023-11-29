@extends('templates.default')
@php
$title = 'Master OPD';
$preTitle = null;
$currentRouteName = Route::currentRouteName();
@endphp

@section('content')
@include('master.opd.toolbar')

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="col-xl mb-md-5 mb-xl-10">
                <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table id="dt_index" class="table table-striped table-bordered gy-5 gs-7 rounded mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Peruntukan</th>
                                        <th scope="col">Nama Perangkat Daerah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body d-flex align-items-center pt-3 pb-0">
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

@include('master.opd.modal')

@push('styles')
    <link href="{{ asset('dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        $(document).ready(function() {
            let table = $('#dt_index').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('opd.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'fs-6 text-center',
                    },
                    {
                        data: 'peruntukans',
                        name: 'peruntukans',
                        className: 'fs-6 text-center',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
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

    @include('master.opd.crud-scripts')
@endpush
@endsection