@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Data Accounts
        </h1>
        <a href="{{route('account.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="bi bi-plus-square fa-sm text-white-50 mr-1"></i>
            Buat Account Baru
        </a>
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-12">
            <div class="card border-left-primary shadow h-100 pt-2 pb-1">
                <div class="card-body pt-2 px-0 pb-0">
                    <div class="row no-gutters align-items-center mb-0 pb-0">

                        @if(session('success'))
                        <div class="col-md-12">

                            <div class="alert alert-success alert-dismissible fade mx-2" role="alert"
                                id="success-alert">

                                {{session('success')}}

                                <button class="btn btn-sm btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close">
                                </button>
                            </div>
                        </div>
                        @endif

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

                        <div class="table-responsive mx-0 pb-0 mb-0">
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 80px;">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Type Deposit</th>
                                        <th scope="col">Balance</th>
                                        <th class="text-center" scope="col" style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accounts as $item)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->customerFk->name}}</td>
                                        <td>{{$item->depositoType->name}}</td>
                                        <td>{{ 'Rp ' . number_format($item->balance, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            {{-- <button class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </button> --}}
                                            <a href="{{route('account.edit', $item->id)}}" title="Edit"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$item->id}}">
                                                <i class="bi bi-trash3"></i>
                                            </button>

                                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete "{{ $item->name }}"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('account.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            <p class="fw-bolder my-0">
                                                Data Kosong
                                            </p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




@endsection
