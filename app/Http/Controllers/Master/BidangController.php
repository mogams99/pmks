<?php

namespace App\Http\Controllers\Master;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBidangRequest;
use App\Http\Requests\UpdateBidangRequest;
use App\Models\Bidang;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.bidang.index');
    }

    public function data(Bidang $bidang)
    {
        $data = $bidang->select('id', 'nama', 'status')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data) {
                return ucwords($data->nama);
            })
            ->addColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.bidang.action', compact('data'));
            })
            ->rawColumns([ 'status', 'action'])
            ->make(true);
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
    public function store(StoreBidangRequest $request)
    {
        try {
            $request->merge(['created_by' => Auth::user()->id]);
            Bidang::create($request->all());
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
    public function show(Bidang $bidang)
    {
        $data = $bidang->toArray();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidang $bidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBidangRequest $request, Bidang $bidang)
    {
        try {
            // ? melakukan validasi input dengan UpdateBidangRequest
            $request->validated();
            // ? melakukan merge updated_by ke $request
            $request->merge(['updated_by' => Auth::user()->id]);
            // ? melakukan update data Bidang
            $bidang->update($request->all());
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
    public function destroy(Bidang $bidang)
    {
        try {
            $bidang->deleted_by = Auth::user()->id;
            $bidang->save();
            $bidang->delete();

            return ResponseHelper::jsonResponse(201, 'Berhasil menghapus data!', null, []);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(500, 'Gagal menghapus data!', null, []);
        }
    }
}
