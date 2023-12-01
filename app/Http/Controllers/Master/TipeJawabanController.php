<?php

namespace App\Http\Controllers\Master;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipeJawabanRequest;
use App\Http\Requests\UpdateTipeJawabanRequest;
use App\Models\TipeJawaban;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TipeJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('master.tipe-jawaban.index');
    }

    public function data(TipeJawaban $tipeJawaban)
    {
        $data = $tipeJawaban->select('id', 'nama', 'status')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data) {
                return ucwords($data->nama);
            })
            ->addColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.tipe-jawaban.action', compact('data'));
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
    public function store(StoreTipeJawabanRequest $request)
    {
        try {
            $request->merge(['created_by' => Auth::user()->id]);
            TipeJawaban::create($request->all());
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
    public function show(TipeJawaban $tipeJawaban)
    {
        $data = $tipeJawaban->toArray();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipeJawaban $tipeJawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipeJawabanRequest $request, TipeJawaban $tipeJawaban)
    {
        try {
            // ? melakukan validasi input dengan UpdateBidangRequest
            $request->validated();
            // ? melakukan merge updated_by ke $request
            $request->merge(['updated_by' => Auth::user()->id]);
            // ? melakukan update data Bidang
            $tipeJawaban->update($request->all());
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
    public function destroy(TipeJawaban $tipeJawaban)
    {
        try {
            $tipeJawaban->deleted_by = Auth::user()->id;
            $tipeJawaban->save();
            $tipeJawaban->delete();

            return ResponseHelper::jsonResponse(201, 'Berhasil menghapus data!', null, []);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(500, 'Gagal menghapus data!', null, []);
        }
    }
}
