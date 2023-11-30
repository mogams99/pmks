<script>
    var modal = '#kt_modal_1';

    function addForm(route, title) {
        // console.log(route, title, 'Add Form');
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`)[0].reset();
        $(`${modal} form`).attr('action', route);
        $(`${modal} form [name=_method]`).val('post');
        resetInput(`${modal} form`);
        resetSelect2();
        getBidangs();
    }

    function resetSelect2() {
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
                window.table.ajax.reload();
            })
            .fail(errors => {
                // return;
                var message = 'Data gagal disimpan.'
                if (errors.status == 422) {
                    showAlert(message, 'gagal');
                    loopErrors(errors.responseJSON.errors);
                    return;
                }

                showAlert(message, 'gagal');
            })
    }

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
                // console.log(response.data.bidangs_id);
                getBidangs(response.data.bidangs_id);
            })
            .fail(errors => {
                var message = 'Data tidak dapat ditampilkan.'
                showAlert(message, 'gagal')
            });
    }

    function deleteData(url) {
        Swal.fire({
            title: 'Yakin ?',
            text: "Menghapus Data Ini ?",
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#87adbd ',
            // cancelButtonColor: '#f27474',
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
                        window.table.ajax.reload();
                    })
                    .fail((errors) => {
                        console.log(errors);
                        var message = 'Data gagal dihapus'
                        showAlert(message, 'gagal')
                    })
            }
        })
    }

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
                        window.table.ajax.reload();
                    })
                    .fail((errors) => {
                        console.log(errors);
                        var message = 'Data gagal diaktifkan'
                        showAlert(message, 'gagal')
                    })
            }
        })
    }

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

    function showAlert(message, type) {
        Swal.fire({
            icon: type === 'success' ? 'success' : 'error',
            title: type === 'success' ? 'Berhasil' : 'Gagal',
            text: message,
        });
    }

    // ? extend scripts
    function getBidangs(selectedId = null) {
        $.ajax({
            url: "{{ route('layanan.data_bidang') }}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var selectElement = $('#bidangs_id');
                selectElement.empty();
                console.log(selectedId);

                var defaultOption = $('<option>', {
                    value: '',
                    text: '- Pilih Bidang -'
                });
                selectElement.append(defaultOption);

                $.each(response.data, function(key, value) {
                    var option = $('<option>', {
                        value: value.id,
                        text: value.nama
                    });

                    // Tandai opsi sebagai "selected" jika ID cocok dengan parameter
                    if (selectedId !== null && selectedId == value.id) {
                        option.attr('selected', 'selected');
                    }

                    selectElement.append(option);
                });

                selectElement.trigger('change');
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    }
</script>