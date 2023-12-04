<?php

namespace App\Http\Controllers\Master;

use App\Helpers\DateHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeriodikRequest;
use App\Http\Requests\UpdatePeriodikRequest;
use App\Models\Periodik;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PeriodikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('master.periodik.index');
    }

    public function data(Periodik $periodik)
    {
        $data = $periodik->select('id', 'nama', 'tgl_mulai', 'tgl_selesai', 'status')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data) {
                return ucwords($data->nama);
            })
            ->addColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.periodik.action', compact('data'));
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
    public function store(StorePeriodikRequest $request)
    {
        try {
            // ? menggunakan helper DateHelper untuk memisahkan rentang tanggal
            $dateData = DateHelper::parseDateRange($request->tgl);
            // ! penyesuaian struktur request
            $request->offsetUnset('tgl');
            $request->merge($dateData);
            $request->merge(['created_by' => Auth::user()->id]);
            // * lakukan proses create periodik
            Periodik::create($request->all());
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
    public function show(Periodik $periodik)
    {
        $periodik->tgl = DateHelper::mergeDateRange($periodik->tgl_mulai, $periodik->tgl_selesai);
        $data = $periodik->toArray();
        return ResponseHelper::jsonResponse(201, 'Berhasil mengumpulkan data!', null, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periodik $periodik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeriodikRequest $request, Periodik $periodik)
    {
        try {
            // ? melakukan validasi input dengan UpdateBidangRequest
            $request->validated();
            // ? menggunakan helper DateHelper untuk memisahkan rentang tanggal
            $dateData = DateHelper::parseDateRange($request->tgl);
            // ! penyesuaian struktur request
            $request->offsetUnset('tgl');
            $request->merge($dateData);
            // ? melakukan merge updated_by ke $request
            $request->merge(['updated_by' => Auth::user()->id]);
            // ? melakukan update data Bidang
            $periodik->update($request->all());
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
    public function destroy(Periodik $periodik)
    {
        try {
            $periodik->deleted_by = Auth::user()->id;
            $periodik->save();
            $periodik->delete();

            return ResponseHelper::jsonResponse(201, 'Berhasil menghapus data!', null, []);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(500, 'Gagal menghapus data!', null, []);
        }
    }
}
