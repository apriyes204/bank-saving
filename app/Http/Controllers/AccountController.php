<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customer;
use App\Models\DepositoType;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::with([
            'customerFK', 'depositoType'
        ])->get();
        return view('pages.account.index', [
            'accounts' => $accounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $depositoTypes = DepositoType::all();
        return view('pages.account.create', [
            'customers' => $customers,
            'depositoTypes' => $depositoTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'customer' => 'required|exists:customers,id',
            'packet' => 'required|exists:deposito_types,id',
            'balance' => 'required|numeric'
        ]);
        try {
            $data = $request->all();
            Account::create($data);
            // $this->updateAccountBalance($accounts);
            return redirect()->route('account.index')->with('success', 'Data berhasil disimpan!');;
        } catch (\Exception $e) {
            return redirect()->route('account.index')->with('error', 'Terjadi Kesalahan : '. $e->getMessage());
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
        $accounts = Account::with([
            'customerFk', 'depositoType'
        ])->findOrFail($id);
        $customers = Customer::all();
        $depositoTypes = DepositoType::all();
        return view('pages.account.edit', [
            'accounts' => $accounts,
            'customerFk' => $customers,
            'depositoTypes' => $depositoTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'packet' => 'required|exists:deposito_types,id',
            'customer' => 'required|exists:customers,id',
            // 'balance' => 'required|numeric',
        ]);
        
        try {
            $data = $request->all();

            // dd($data);

            $accounts = Account::findOrFail($id);
            $accounts->update($data);
            // $this->updateAccountBalance($accounts);
            return redirect()->route('account.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('account.edit', $id)
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: '. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $accounts = Account::findOrFail($id);
            $accounts->delete();
            return redirect()->route('account.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->route('account.index')->with('error', 'Terjadi kesalahan!');
        }
    }

    private function updateAccountBalance(Account $account)
    {
        // Ambil nilai return tahunan dari deposito_type
        $yearlyReturn = $account->depositoType->return_yearly;
        // Hitung return bulanan
        $monthlyReturn = $yearlyReturn / 12 / 100;

        // Ambil saldo awal
        $startingBalance = $account->balance;

        // Hitung total deposit dan withdraw
        $totalDeposits = $account->transaction()->where('jenis_transaksi', 'deposit')->sum('amount');
        $totalWithdrawals = $account->transaction()->where('jenis_transaksi', 'withdraw')->sum('amount');

        // Hitung saldo berdasarkan transaksi
        $currentBalance = $startingBalance + $totalDeposits - $totalWithdrawals;

        // Hitung saldo akhir berdasarkan return bulanan
        $months = now()->diffInMonths($account->created_at);
        $endingBalance = $currentBalance * (1 + $monthlyReturn) ** $months;

        // Update balance di model Account
        $account->balance = $endingBalance;
        $account->save();
    }
}
