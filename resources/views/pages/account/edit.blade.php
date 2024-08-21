@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Merubah Data Account {{$accounts->name}}
        </h1>
        <a href="{{route('account.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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

                        <form action="{{route('account.update', $accounts->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Name Account</label>
                                <input type="text" class="form-control" name="name" 
                                    value="{{old('name', $accounts->name)}}" id="inputName"
                                    aria-describedby="nameHelp" placeholder="{{old('name', $accounts->name)}}">
                            </div>
                            <div class="mb-3">
                                <label for="inputCustomer" class="form-label">Select Customer</label>
                                <select name="customer" id="inputCustomer" class="form-select"
                                    aria-label="inputCustomer">
                                    <option value="{{old('customer_id', $accounts->customer)}}" selected>{{$accounts->customerFk->name}}: Data Sebelumnya</option>
                                    @foreach ($customerFk as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $customer->id == $customer->customer ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputDepositoType" class="form-label">Select Deposito Type</label>
                                <select name="packet" id="inputDepositoType" class="form-select"
                                    aria-label="inputDepositoType">
                                    <option value="{{old('packet', $accounts->packet)}}" selected>{{$accounts->depositoType->name}} : Data Sebelumnya</option>
                                    @foreach ($depositoTypes as $depo)
                                    <option value="{{ $depo->id }}"
                                        {{ $depo->id == $depo->packet ? 'selected' : '' }}>
                                        {{ $depo->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('account.index')}}" class="btn btn-secondary">
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
