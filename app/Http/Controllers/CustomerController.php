<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->paginate(5);// Mengecek apakah data kosong

        return view('pages.customers.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        try {
            $data = $request->all();
            Customer::create($data);
            return redirect()->route('customers.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('customers.create')->with('error', 'Terjadi Kesalahan : '. $e->getMessage());
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
        $customers = Customer::findOrFail($id);
        return view('pages.customers.edit', [
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        try {
            $data = $request->all();
            $items = Customer::findOrFail($id);
            $items -> update($data);
            return redirect()->route('customers.index')->with('success', 'Data berhasil disimpan!');;
        } catch (\Exception $e) {
            return redirect()->route('customers.edit', $id)
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
            $customers = Customer::findOrFail($id);
            $customers->delete();
            return redirect()->route('customers.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->route('customers.index')->with('error', 'Terjadi Kesalahan : '. $e->getMessage());
        }
        
    }
}
