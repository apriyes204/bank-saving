@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Create New Type Deposito
        </h1>
        <a href="{{route('deposito-type.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="bi bi-house fa-sm text-white-50 mr-1"></i>
            Back
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

                        <form action="{{route('deposito-type.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Name Type Deposito</label>
                                <input type="text" class="form-control" name="name" id="inputName"
                                    aria-describedby="nameHelp" placeholder="Name Type Deposito">
                            </div>
                            <div class="mb-3">
                                <label for="inputReturn" class="form-label">Return Yearly (%)</label>
                                <input type="number" class="form-control" step="0.01" name="return" id="inputReturn"
                                    aria-describedby="returnHelp" placeholder="Return Yearly (%)">
                                <small id="decimalHelp" class="form-text text-muted">Enter a decimal value with up to two decimal places.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('deposito-type.index')}}" class="btn btn-secondary">
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
