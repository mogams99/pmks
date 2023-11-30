@php
    $url = 'roles.index';
    $akses = App\Models\Role::getAkses($url);
@endphp

<div class="d-flex justify-content-center">
    @if ($akses->update == 't')
        <button class="btn btn-icon btn-warning me-2" title="Ubah" type="button"
            onclick="editForm(`{{ route('roles.update', $data->id) }}`, 'Edit OPD')">
            <i class="bi bi-pencil-square fs-3"></i>
        </button>
    @endif

    @if ($akses->delete == 't')
        <button class="btn btn-icon btn-danger me-2" title="Hapus" type="button"
            onclick="deleteData(`{{ route('roles.destroy', $data->id) }}`)">
            <i class="bi bi-trash-fill fs-3"></i>
        </button>
    @endif
</div>
