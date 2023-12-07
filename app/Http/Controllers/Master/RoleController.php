<?php

namespace App\Http\Controllers\Master;

use App\Models\Role;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = 'roles.index';
        $permision = Role::getAkses($url);
        // dd($permision);
        if ($permision) {
            $data['akses'] = Role::getAkses($url);
            return view('master.role.index', $data);
        }
        return view('error.403');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function data()
    {
        $data = Role::getRole();
        return datatables($data)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.role.action', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $request->merge(['created_by' => Auth::user()->id]);
            Role::create($request->all());
            // ? mengirim respons berhasil
            return ResponseHelper::jsonResponse(201, 'Berhasil menyimpan data!', null, []);
        } catch (QueryException $e) {
            // ? menangani kesalahan query
            return ResponseHelper::jsonResponse(500, 'Terjadi kesalahan saat menyimpan data.', null, []);
        } catch (\Exception $e) {
            // ? menangani kesalahan umum
            return ResponseHelper::jsonResponse(500, 'Terjadi kesalahan.', null, []);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $data = $role->toArray();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            // ? melakukan validasi input dengan UpdateBidangRequest
            $request->validated();
            // ? melakukan merge updated_by ke $request
            $request->merge(['updated_by' => Auth::user()->id]);
            // ? melakukan update data Bidang
            $role->update($request->all());
            // ? memberikan respons berhasil
            return ResponseHelper::jsonResponse(201, 'Berhasil mengubah data!', null, []);
        } catch (\Exception $e) {
            // ? memberikan respons gagal
            return ResponseHelper::jsonResponse(500, 'Gagal mengubah data!', null, []);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();

            return ResponseHelper::jsonResponse(201, 'Berhasil menghapus data!', null, []);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(500, 'Gagal menghapus data!', null, []);
        }
    }

    // Funsi untuk konfigurasi akses role
    public function akses($id)
    {
        $id = decrypt($id);
        $data = Role::getTableAkses($id);
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('master.role.action', compact('data'));
            })
            ->rawColumns(['action',])
            ->make(true);
    }
    // End : Funsi untuk konfigurasi akses role
}
