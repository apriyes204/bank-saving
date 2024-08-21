<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->with(['account','customer'])->paginate(10);
        return view('pages.transaction.index', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
        $accounts = Account::all();
        $customers = Customer::all();
        return view('pages.transaction.create', [
            'accounts' => $accounts,
            'customers' => $customers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'account_id' => 'required|exists:accounts,id',
            'status' => 'required|in:deposit,withdraw',
            'amount' => 'required|numeric|min:0',
            'transactions_date' => 'required|date',
        ]);
        try {
            $data = $request->all();
            // dd($data);
            // Menyimpan transaksi baru
            $transaction = Transaction::create($data);
            // dd($transaction); 

            // Update saldo akun berdasarkan jenis transaksi
            $account = $transaction->account;
            if ($transaction->status === 'deposit') {
                $account->balance += $transaction->amount;
            } else {
                $account->balance -= $transaction->amount;
            }
            $account->save();

            // Redirect dengan pesan sukses
            return redirect()->route('transaction.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('transaction.index')->with('error', 'Terjadi Kesalahan : '. $e->getMessage());
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
        $transactions = Transaction::with([
            'customer',
            'account'
        ])->findOrFail($id);
        $customers = Customer::all();
        $accounts = Account::all();
        return view('pages.transaction.edit', [
            'customers' => $customers,
            'accounts' => $accounts,
            'transactions' => $transactions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'account_id' => 'required|exists:accounts,id',
            'status' => 'required|in:deposit,withdraw',
            'transactions_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);
        try {
            $data = $request->all();
            $items = Transaction::findOrFail($id);
            // dd($data);
            $items -> update($data);
            // Recalculate account balance
            $account = $items->account;
            $account->balance = $account->calculateFinalBalance($request->input('months'));
            $account->save();
            // Update balance based on the new transaction
            if ($request->input('status') === 'deposit') {
                $account->balance += $request->input('amount');
            } else {
                $account->balance -= $request->input('amount');
            }
            $account->save();
            return redirect()->route('transaction.index')->with('success', 'Data berhasil disimpan!');;
        } catch (\Exception $e) {
            return redirect()->route('transaction.edit', $id)
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
            $transactions = Transaction::findOrFail($id);

            // Revert account balance
            $account = $transactions->account;
            if ($transactions->status === 'deposit') {
                $account->balance -= $transactions->jumlah;
            } else {
                $account->balance += $transactions->jumlah;
            }
            $account->save();

            $transactions->delete();
            return redirect()->route('transaction.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->route('transaction.index')->with('error', 'Terjadi Kesalahan : '. $e->getMessage());
        }
    }
}
