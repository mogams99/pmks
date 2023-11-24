<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpdRequest;
use App\Http\Requests\UpdateOpdRequest;
use App\Models\Opd;
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
        $data = $opd->select('id', 'peruntukans_id', 'nama')->with('peruntukans')->get();
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data) {
                return ucwords($data->nama);
            })
            ->addColumn('peruntukans', function ($data) {
                return ucwords($data->peruntukans->nama);
            })
            ->toJson();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Opd $opd)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opd $opd)
    {
        //
    }
}
