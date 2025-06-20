<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function datepicker(Request $request)
    {
        $query = \App\Models\BarangModel::query();
    
        // Filter berdasarkan tanggal masuk (atau sesuaikan dengan field tanggal di tabel Anda)
        if ($request->filled('start') && $request->filled('end')) {
            $query->whereBetween('created_at', [
                $request->start . ' 00:00:00',
                $request->end . ' 23:59:59'
            ]);
    }
    
        $barangs = $query->get();
    
        return view('laporanbarang', compact('barangs'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
