@extends('layout.master')

@section('activekuAdmin')
    activeku
@endsection

@section('judul')
    <i class="fa fa-book"></i> Data Admin
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#exampleModal">
            Tambah Admin
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('admin.store', []) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class='form-group'>
                            <label for='forusername' class='text-capitalize'>Username</label>
                            <input type='text' name='username' id='forusername' class='form-control' placeholder='masukan username'>
                        </div>
                        <div class='form-group'>
                            <label for='forpassword' class='text-capitalize'>Password</label>
                            <input type='password' name='password' id='forpassword' class='form-control' placeholder='masukan password'>
                        </div>
                        <div class='form-group'>
                            <label for='forposisi' class='text-capitalize'>Posisi</label>
                            <select name='posisi' id='forposisi' class='form-control'>
                                <option value=''>Pilih</option>
                                <option value='tu'>TU</option>
                                <option value='perpus'>Perpus</option>
                                <option value='superadmin'>Superadmin</option>
                            <select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Admin</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}" class="form-inline justify-content-end">
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" name="keyword" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>

        </form>
    </div>
</div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>username</td>
                        <td>Posisi</td>
                        <td>aksi</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admin as $item)
                    <tr>
                        <td nowrap width="3%">{{$loop->iteration}}</td>
                        <td>{{$item->username}}</td>
                        <td class="text-center text-bold text-uppercase">{{$item->posisi}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#edit{{$item->idadminkelulusan}}">
                              <i class="fa fa-edit"></i> Edit
                            </button>

                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-danger border-0 py-1" data-toggle="modal" data-target="#hapus{{$item->idadminkelulusan}}">
                              <i class="fa fa-trash"></i> Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="hapus{{$item->idadminkelulusan}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title">HAPUS</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <form action="{{ route('admin.destroy', [$item->idadminkelulusan]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <font class="text-danger"><p>
                                                    Yakin ingin menghapus data tersebut?
                                                </p></font>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Hapus Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$item->idadminkelulusan}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">EDIT</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('admin.update', [$item->idadminkelulusan]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='forusername' class='text-capitalize'>Username</label>
                                            <input type='text' name='username' id='forusername' class='form-control' value="{{$item->username}}" readonly>
                                        </div>
                                        <div class='form-group'>
                                            <label for='forpassword' class='text-capitalize'>Password</label>
                                            <input type='password' name='password' id='forpassword' class='form-control' placeholder='masukan password'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='forposisi' class='text-capitalize'>Posisi</label>
                                            <select name='posisi' id='forposisi' class='form-control'>
                                                <option value=''>Pilih</option>
                                                <option value='tu' @if ($item->posisi == 'tu')
                                                    selected
                                                @endif>TU</option>
                                                <option value='perpus' @if ($item->posisi == 'perpus')
                                                    selected
                                                @endif>Perpus</option>
                                                <option value='superadmin' @if ($item->posisi == 'superadmin')
                                                    selected
                                                @endif>Superadmin</option>
                                            <select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
