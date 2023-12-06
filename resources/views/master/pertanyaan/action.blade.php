<div class="d-flex justify-content-center">
    <button class="btn btn-icon btn-warning me-2" title="Ubah" type="button" onclick="editForm(`{{ route('bidang.update', ['bidang' => $data->id]) }}`, 'Edit OPD')">
        <i class="bi bi-pencil-square fs-3"></i>
    </button>
    <button class="btn btn-icon btn-danger me-2" title="Hapus" type="button" onclick="deleteData(`{{ route('bidang.destroy', ['bidang' => $data->id]) }}`)"><i class="bi bi-trash-fill fs-3"></i></button>
</div>