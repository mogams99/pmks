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
                <div class="col-xl">
                    <div class="card shadow-sm">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table id="dt_index" class="table table-striped table-bordered gy-5 gs-7 rounded mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Peruntukan</th>
                                            <th scope="col">Nama Perangkat Daerah</th>
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
        <link href="{{ asset('dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
    @endpush
    @push('scripts')
        <script src="{{ asset('dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#dt_index').DataTable({
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
                        processing: "<div class='d-flex justify-content-center align-items-center'><img src='{{ asset('dist/assets/img/icons/logo-sby.svg') }}' class='img-fluid' style='width: 100px; height: 100px;'></div>",
                    },
                });
            });
        </script>

        <script>
            var modal = '#kt_modal_1';

            function addForm(route, title) {
                console.log(route, title, 'halo gaes');
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`)[0].reset();
                $(`${modal} form`).attr('action', route);
                $(`${modal} form [name=_method]`).val('post');
                resetInput(`${modal} form`);
                // resetForm(`${modal} form`);
                reset_select_2();
            }

            function reset_select_2() {
                $('.select_2').trigger('change');
            }

            function submitForm(originalForm) {
                $.post({
                        url: $(originalForm).attr('action'),
                        data: new FormData(originalForm),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false
                    })
                    .done(response => {
                        $(modal).modal('hide');
                        showAlert(response.message, 'success');
                        table.ajax.reload();
                    })
                    .fail(errors => {
                        // return;
                        var message = 'Data gagal disimpan.'
                        if (errors.status == 422) {
                            showAlert(message, 'gagal');
                            loopErrors(errors.responseJSON.errors);
                            return;
                        }

                        // showAlert(message, 'gagal');
                    })
            }

            // ---- Start Function untuk Edit data
            function editForm(url, title) {
                $.get(url).done(response => {
                        $('#emailStatus').text('').removeClass('text-danger');
                        $('#email').removeClass('is-invalid');
                        $(modal).modal('show');
                        $(`${modal} .modal-title`).text(title);
                        $(`${modal} form`).attr('action', url);
                        $(`${modal} [name=_method]`).val('put');

                        resetInput(`${modal} form`);
                        loopForm(response.data);
                    })
                    .fail(errors => {
                        var message = 'Data tidak dapat ditampilkan.'
                        showAlert(message, 'gagal')
                    });
            }
            // ---- End Function untuk Edit data

            // ---- Start Function untuk delete data
            function deleteData(url) {
                Swal.fire({
                    title: 'Yakin ?',
                    text: "Menghapus Data Ini ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#87adbd ',
                    cancelButtonColor: '#f27474',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',

                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(url, {
                                '_token': $('[name=csrf-token]').attr('content'),
                                '_method': 'delete'
                            })
                            .done((response) => {
                                showAlert(response.message, 'success');
                                // timeOut();
                                table.ajax.reload();
                            })
                            .fail((errors) => {
                                console.log(errors);
                                var message = 'Data gagal dihapus'
                                showAlert(message, 'gagal')
                            })
                    }
                })
            }
            // ---- End Function untuk delete data

            // ---- Start Function untuk restore data
            function restoreData(url) {
                Swal.fire({
                    title: 'Yakin ?',
                    text: "Mengaktifkan Data Ini ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#87adbd ',
                    cancelButtonColor: '#f27474',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',

                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(url, {
                                '_token': $('[name=csrf-token]').attr('content'),
                                '_method': 'POST'
                            })
                            .done((response) => {
                                showAlert(response.message, 'success');
                                // timeOut();
                                table.ajax.reload();
                            })
                            .fail((errors) => {
                                console.log(errors);
                                var message = 'Data gagal diaktifkan'
                                showAlert(message, 'gagal')
                            })
                    }
                })
            }
            // ---- End Function untuk restore data


            // *************************************************************
            function loopErrors(errors, message = true) {
                $('.invalid-feedback').remove();

                if (errors == undefined) {
                    return;
                }

                for (error in errors) {
                    $(`[name=${error}]`).addClass('is-invalid');

                    if ($(`[name=${error}]`).hasClass('select2')) {
                        $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                            .insertAfter($(`[name=${error}]`).next());
                    } else if ($(`[name=${error}]`).hasClass('summernote')) {
                        $('.note-editor').addClass('is-invalid');
                        $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                            .insertAfter($(`[name=${error}]`).next());
                    } else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
                        $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                            .insertAfter($(`[name=${error}]`).next());
                    } else {
                        if ($(`[name=${error}]`).length == 0) {
                            $(`[name="${error}[]"]`).addClass('is-invalid');
                            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                                .insertAfter($(`[name="${error}[]"]`).next());
                        } else {
                            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                                .insertAfter($(`[name=${error}]`));
                        }
                    }
                }
            }

            function resetInput(selector) {
                $('.form-control, .custom-select, [type=radio], [type=checkbox], [type=file], .custom-radio, .select_2, .note-editor')
                    .removeClass('is-invalid');
            }

            function resetForm(selector) {
                $(selector)[0].reset();
                $('.select_2').trigger('change');
                $(`[name=body]`).summernote('code', '');
                $('.form-control, .custom-select, [type=radio], [type=checkbox], [type=file], .custom-radio, .select_2, .note-editor')
                    .removeClass('is-invalid');
                $('.invalid-feedback').remove();
                $(`.preview-path_image`).attr('src', '').hide();
                $(`#preview-image`).attr('src', '').hide();
            }

            function loopForm(originalForm) {
                for (field in originalForm) {
                    if ($(`[name=${field}]`).attr('type') != 'file') {
                        if ($(`[name=${field}]`).hasClass('summernote')) {
                            $(`[name=${field}]`).summernote('code', originalForm[field])
                        } else if ($(`[name=${field}]`).attr('type') == 'radio') {
                            $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true);
                        } else {
                            $(`[name=${field}]`).val(originalForm[field]);
                        }
                        $('select').trigger('change');
                    } else {
                        $(`.preview-${field}`).attr('src', '/storage/' +
                            originalForm[field]).show();
                    }
                }
            }

            function timeOut() {
                setTimeout(function() {
                    location.reload();
                }, 2500);
            }
        </script>
    @endpush
@endsection``
