@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Merubah Data Customer {{$customers->name}}
        </h1>
        <a href="{{route('customers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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

                        <form action="{{route('customers.update', $customers->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{old('name', $customers->name)}}" id="inputName" aria-describedby="nameHelp"
                                    placeholder="Full Name">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('customers.index')}}" class="btn btn-secondary">
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
