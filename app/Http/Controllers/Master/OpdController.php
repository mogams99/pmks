<?php

namespace App\Http\Controllers\Master;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpdRequest;
use App\Http\Requests\UpdateOpdRequest;
use App\Models\Opd;
use App\Models\Peruntukan;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.opd.index');
    }

    public function data(Opd $opd)
    {
        $data = $opd->select('id', 'peruntukans_id', 'nama', 'status')->with('peruntukans')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data) {
                return ucwords($data->nama);
            })
            ->addColumn('peruntukans', function ($data) {
                return ucwords($data->peruntukans->nama);
            })
            ->addColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.opd.action', compact('data'));
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function dataPeruntukan(Peruntukan $prt)
    {
        $data = $prt->all();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpdRequest $request)
    {
        try {
            $request->merge(['created_by' => Auth::user()->id]);
            // ? membuat dan menyimpan record ke database
            Opd::create($request->all());
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
    public function show(Opd $opd)
    {
        $data = $opd->load('peruntukans')->toArray();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opd $opd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpdRequest $request, Opd $opd)
    {
        try {
            // ? validasi input menggunakan UpdateOpdRequest
            $request->validated();
            // ? melakukan merge updated_by ke $request
            $request->merge(['updated_by' => Auth::user()->id]);
            // ? update data OPD
            $opd->update($request->all());
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
    public function destroy(Opd $opd)
    {
        try {
            $opd->deleted_by = Auth::user()->id;
            $opd->save();
            $opd->delete();

            return ResponseHelper::jsonResponse(201, 'Berhasil menghapus data!', null, []);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(500, 'Gagal menghapus data!', null, []);
        }
    }
}
