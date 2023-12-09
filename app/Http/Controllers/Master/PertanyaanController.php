<?php

namespace App\Http\Controllers\Master;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePertanyaanRequest;
use App\Http\Requests\UpdatePertanyaanRequest;
use App\Models\Layanan;
use App\Models\Pertanyaan;
use App\Models\TipeJawaban;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('master.pertanyaan.index');
    }

    public function data(Pertanyaan $pertanyaan)
    {
        $data = $pertanyaan
            ->select('id', 'tipe_jawabans_id', 'layanans_id', 'nama', 'status')
            ->with(['tipe_jawabans', 'layanans', 'layanans.bidangs'])
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data) {
                return ucwords($data->nama);
            })
            ->addColumn('tipe_jawabans', function ($data) {
                return $data->tipe_jawabans->nama;
            })
            ->addColumn('layanans', function ($data) {
                return $data->layanans->bidangs->nama . ' - ' . $data->layanans->nama;
            })
            ->addColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.pertanyaan.action', compact('data'));
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function dataLayanan($param, Layanan $layanan)
    {
        $data = $layanan->select('id', 'bidangs_id', 'nama', 'status')
            ->where([
                ['status', '=', true],
                ['bidangs_id', '=', $param],
            ])
            ->get();

        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    public function dataTipeJawaban(TipeJawaban $tipeJawaban)
    {
        $data = $tipeJawaban->select('id', 'nama', 'status')
            ->where('status', true)
            ->get();

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
    public function store(StorePertanyaanRequest $request)
    {
        try {
            $request->merge(['created_by' => Auth::user()->id]);
            // ? membuat dan menyimpan record ke database
            Pertanyaan::create($request->all());
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
    public function show(Pertanyaan $pertanyaan)
    {
        $data = $pertanyaan->load('layanans')->toArray();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePertanyaanRequest $request, Pertanyaan $pertanyaan)
    {
        try {
            // ? validasi input menggunakan UpdateOpdRequest
            $request->validated();
            // ? melakukan merge updated_by ke $request
            $request->merge(['updated_by' => Auth::user()->id]);
            // ? update data OPD
            $pertanyaan->update($request->all());
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
    public function destroy(Pertanyaan $pertanyaan)
    {
        try {
            $pertanyaan->deleted_by = Auth::user()->id;
            $pertanyaan->save();
            $pertanyaan->delete();

            return ResponseHelper::jsonResponse(201, 'Berhasil menghapus data!', null, []);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(500, 'Gagal menghapus data!', null, []);
        }
    }
}
