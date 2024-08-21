<?php

namespace App\Http\Controllers;

use App\Models\DepositoType;
use Illuminate\Http\Request;

class DepositoTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depositoTypes = DepositoType::all();// Mengecek apakah data kosong

        return view('pages.depositoType.index', [
            'depositoType' => $depositoTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.depositoType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'return' => 'required|numeric'
        ]);
        try {
            $data = $request->all();
            DepositoType::create($data);
            return redirect()->route('deposito-type.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('deposito-type.create')->with('error', 'Terjadi Kesalahan : '. $e->getMessage());
        }
        
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
        $depositoTypes = DepositoType::findOrFail($id);
        return view('pages.depositoType.edit', [
            'depositoType' => $depositoTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'return' => 'required|numeric'
        ]);
        try {
            $data = $request->all();
            $items = DepositoType::findOrFail($id);
            $items->update($data);
            return redirect()->route('deposito-type.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('deposito-type.edit', $id)
                ->withInput()
                ->withErrors(['error' => 'Terjadi Kesalahan : '. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $depositoTypes = DepositoType::findOrFail($id);
            $depositoTypes->delete();
            return redirect()->route('deposito-type.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->route('deposito-type.index')->with('error', 'Terjadi Kesalahan : '. $e->getMessage());
        }
    }
}
