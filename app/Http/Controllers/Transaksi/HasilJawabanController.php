<?php

namespace App\Http\Controllers\Transaksi;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHasilJawabanRequest;
use App\Http\Requests\UpdateHasilJawabanRequest;
use App\Models\HasilJawaban;

class HasilJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return 'Sedang Maintenance';
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
    public function store(StoreHasilJawabanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HasilJawaban $hasilJawaban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilJawaban $hasilJawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHasilJawabanRequest $request, HasilJawaban $hasilJawaban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilJawaban $hasilJawaban)
    {
        //
    }
}
