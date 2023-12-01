<div class="d-flex justify-content-center">
    <button class="btn btn-icon btn-warning me-2" title="Ubah" type="button" onclick="editForm(`{{ route('tipe_jawaban.update', ['tipe_jawaban' => $data->id]) }}`, 'Edit OPD')">
        <i class="bi bi-pencil-square fs-3"></i>
    </button>
    <button class="btn btn-icon btn-danger me-2" title="Hapus" type="button" onclick="deleteData(`{{ route('tipe_jawaban.destroy', ['tipe_jawaban' => $data->id]) }}`)"><i class="bi bi-trash-fill fs-3"></i></button>
</div>