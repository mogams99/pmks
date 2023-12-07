<div class="modal fade" tabindex="-1" id="kt_modal_table">
    <div class="modal-dialog modal-xl">
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

                <div class="table-responsive">
                    <table id="table_akses" class="table table-striped table-bordered gy-5 gs-7 rounded mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" width="10%">No.</th>
                                <th scope="col">Menu</th>
                                <th scope="col" class="text-center" width="8%">Select</th>
                                <th scope="col" class="text-center" width="8%">Create</th>
                                <th scope="col" class="text-center" width="8%">Update</th>
                                <th scope="col" class="text-center" width="8%">Delete</th>
                                <th scope="col" class="text-center" width="8%">Print</th>
                                <th scope="col" class="text-center" width="8%">Export</th>
                                <th scope="col" class="text-center" width="8%">Import</th>
                                {{-- @if ($akses->update == 't' || $akses->delete == 't')
                                    <th scope="col" class="text-center" width="10%">Aksi</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
