@extends('layout.master')

@section('activekuPengaturan')
    activeku
@endsection

@section('judul')
    <i class="fa fa-wrench"></i> Pengaturan
@endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>WAKTU KELULUSAN DIBUKA (personal)</h5>
            </div>

            <form action="{{ route('pengaturan.open1', []) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class='form-group'>
                        <label for='foropen' class='text-capitalize'>Waktu Lulus 1</label>
                        <input type='datetime-local' name='open' id='foropen' value="{{$open->open}}" class='form-control' placeholder=''>
                    </div>

                    <h4>
                        ket: <br>
                        {{\Carbon\Carbon::parse($open->open)->isoFormat('dddd, DD MMMM Y')}}
                    </h4>
                </div>
                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-secondary">
                        reset
                    </button>
                    <button type="submit" class="btn btn-success">
                        UPDATE WAKTU
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>WAKTU KELULUSAN DIBUKA (persentase kelulusan)</h5>
            </div>
            <form action="{{ route('pengaturan.open2', []) }}" method="post">
                @csrf
            <div class="card-body">
                <div class='form-group'>
                    <label for='foropen2' class='text-capitalize'>Waktu Lulus (PERSENTASE)</label>
                    <input type='datetime-local' name='open2' id='foropen2' class='form-control' value="{{$open->open2}}" placeholder=''>
                </div>
                <h4>
                    ket: <br>
                    {{\Carbon\Carbon::parse($open->open2)->isoFormat('dddd, DD MMMM Y')}}
                </h4>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-secondary">
                    reset
                </button>
                <button type="submit" class="btn btn-success">
                    UPDATE WAKTU
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
