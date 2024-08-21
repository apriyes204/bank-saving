@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Membuat Transaksi Baru
        </h1>
        <a href="{{route('transaction.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="bi bi-house fa-sm text-white-50 mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        @if ($errors->any())
                        <div class="alert alert-success d-flex align-items-center mx-2" role="alert" id="error-alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            <button class="btn btn-sm btn-close" type="button" data-bs-dismiss="alert"
                                aria-label="Close">

                            </button>
                        </div>
                        @endif

                        <form action="{{ route('transaction.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="inputCustomer" class="form-label">Select Customer</label>
                                <select name="customer_id" id="inputCustomer" class="form-select" aria-label="Select Customer" required>
                                    <option value="" disabled selected>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputAccount" class="form-label">Select Account</label>
                                <select name="account_id" id="inputAccount" class="form-select" aria-label="Select Account" required>
                                    <option value="" disabled selected>Select Account</option>
                                    @foreach ($accounts as $acc)
                                        <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputStatus" class="form-label">Status Transaction</label>
                                <select name="status" id="inputStatus" class="form-select" aria-label="Select Status" required>
                                    <option value="" disabled selected>Select Status Transaction</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdraw">Withdraw</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputAmount" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" id="inputAmount" step="0.01" aria-describedby="amountHelp" placeholder="Amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputDate" class="form-label">Date</label>
                                <input type="datetime-local" class="form-control" name="transactions_date" id="inputDate" aria-describedby="dateHelp" placeholder="Date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
