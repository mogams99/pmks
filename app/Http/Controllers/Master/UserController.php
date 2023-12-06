<?php

namespace App\Http\Controllers\Master;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = 'user.index';
        $permision = Role::getAkses($url);
        if ($permision) {
            $data['akses'] = Role::getAkses($url);
            $data['getRole'] = User::getUser();
            return view('master.user.index', $data);
        }
        return view('error.403');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function data()
    {
        $data = User::getUser();
        return datatables($data)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.user.action', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function data_role()
    {
        $data = Role::all();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $request->merge(['created_by' => Auth::user()->id]);
            // ? membuat dan menyimpan record ke database
            User::create($request->all());
            // ? memberikan respons berhasil
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
    public function show(User $user)
    {
        $data = $user->load('getRoleSingle')->toArray();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            // ? validasi input menggunakan UpdateUserRequest
            $request->validated();
            // ? melakukan merge updated_by ke $request
            $request->merge(['updated_by' => Auth::user()->id]);
            // ? update data OPD
            $user->update($request->all());
            // ? berikan respons berhasil
            return ResponseHelper::jsonResponse(201, 'Berhasil mengubah data!', null, []);
        } catch (\Exception $e) {
            // ? tangani kesalahan umum
            return ResponseHelper::jsonResponse(500, 'Gagal mengubah data!', null, []);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->deleted_by = Auth::user()->id;
            $user->save();
            $user->delete();

            return ResponseHelper::jsonResponse(201, 'Berhasil menghapus data!', null, []);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(500, 'Gagal menghapus data!', null, []);
        }
    }
}
