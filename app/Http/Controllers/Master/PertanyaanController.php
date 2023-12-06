<?php

namespace App\Http\Controllers\Master;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePertanyaanRequest;
use App\Http\Requests\UpdatePertanyaanRequest;
use App\Models\Pertanyaan;

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
        $data = $pertanyaan->select('id', 'tipe_jawabans_id', 'layanans_id', 'nama', 'status')->get();
        dd($data);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data) {
                return ucwords($data->nama);
            })
            ->addColumn('status', function ($data) {
                return $data->status ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })
            ->addColumn('action', function ($data) {
                return view('master.pertanyaan.action', compact('data'));
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
    public function store(StorePertanyaanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pertanyaan $pertanyaan)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        //
    }
}
