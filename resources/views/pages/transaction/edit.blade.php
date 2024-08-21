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

                        <form action="{{route('transaction.update', $transactions->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="inputCustomer" class="form-label">Select Customer</label>
                                <select name="customer_id" id="inputCustomer" class="form-select"
                                    value="{{old('customer_id', $transactions->customer_id)}}" aria-label="inputCustomer">
                                    <option value="{{old('customer_id', $transactions->customer_id)}}" selected>{{$transactions->customer->name}} : Data Sebelumnya</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $customer->id == $customer->customer_id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputAccount" class="form-label">Select Account</label>
                                <select name="account_id" id="inputAccount" class="form-select" aria-label="inputAccount">
                                    <option value="{{old('account_id', $transactions->account_id)}}" selected>{{$transactions->account->name}} : Data Sebelumnya</option>
                                    @foreach ($accounts as $acc)
                                    <option value="{{ $acc->id }}"
                                        {{ $acc->id == $acc->account_id ? 'selected' : '' }}>
                                        {{ $acc->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputStatus" class="form-label">Status Transaction</label>
                                <select name="status" id="inputStatus" class="form-select" aria-label="inputStatus">
                                    <option value="{{old('status', $transactions->status)}}" selected>{{$transactions->status}} : Data Sebelumnya</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdraw">Withdraw</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputAmount" class="form-label">Amount</label>
                                <input value="{{old('amount', $transactions->amount)}}"  type="number" class="form-control" name="amount" id="inputAmount" step="0.01"
                                    aria-describedby="amountHelp" placeholder="Amount">
                            </div>
                            <div class="mb-3">
                                <label for="inputDate" class="form-label">Date</label>
                                <input value="{{old('transactions_date', $transactions->transactions_date)}}" type="datetime-local" class="form-control" name="transactions_date" id="inputDate"
                                    aria-describedby="dateHelp" placeholder="{{$transactions->transactions_date}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('transaction.index')}}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
