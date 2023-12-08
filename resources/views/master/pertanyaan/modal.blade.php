<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Modal title</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="" method="POST">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Bidang</label>
                        <select class="form-select" data-control="select2" data-placeholder="- Pilih Bidang -" id="bidangs_id">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Layanan</label>
                        <select class="form-select" data-control="select2" data-placeholder="- Pilih Layanan -" id="layanans_id" name="layanans_id" disabled>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Pertanyaan</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tipe</label>
                        <select class="form-select" data-control="select2" data-placeholder="- Pilih Tipe -" id="tipe_jawabans_id" name="tipe_jawabans_id">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Status</label>

                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="radio" value="true" id="statusAktif" name="status">
                            <label class="form-check-label" for="statusAktif">
                                Aktif
                            </label>
                        </div>

                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="false" id="statusTidakAktif" name="status">
                            <label class="form-check-label" for="statusTidakAktif">
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>