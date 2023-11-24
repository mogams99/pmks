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

                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon1">OPD</span>
                        <input type="text" class="form-control" placeholder="nama" aria-label="nama"
                            aria-describedby="basic-addon1" name="nama" id="nama" />
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
