@extends('layout.login')

@section('title')
    Login
@endsection
@section('headers')
<link rel="stylesheet" href="{{ url('/select2/dist/css/select2.min.css', []) }}">
@endsection
@section('footers')
<link rel="stylesheet" href="{{ url('/select2/dist/js/select2.min.js', []) }}">
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection

@section('kelulusan1')
    active
@endsection


@section('content')

<div class="row mt-5">
    <div class="col-md-4"></div>
    <div class="col-md-4 ">
        <div class="card m-2">
            <div class="card-header bg-light">
                <h5 class="m-0" class="text-bold"><b>IDENTITAS</b></h5>
            </div>
            <form action="{{ route('lihat.lulus', []) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class='form-group'>
                        <label for="">Nama Siswa</label>
                        <select required class="js-example-basic-single form-control form-control-sm" style="width: 100%" name="siswa">
                            <option value="">Pilih Siswa</option>
                            @foreach ($siswa as $item)
                            <option value="{{$item->idsiswa}}">{{strtoupper($item->nama)}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class='form-group'>
                        <label for='fornisn' class='text-capitalize'>NISN</label>
                        <input type='number' name='nisn' id='fornisn' class='form-control form-control-sm' placeholder='masukan NISN'>
                    </div>
                    <div class='form-group'>
                        <label for='passid' class='text-capitalize'>Pass ID</label>
                        <input type='number' name='passid' id='passid' class='form-control form-control-sm' placeholder='masukan Pass ID'>
                    </div>

                </div>
                <div class="card-footert bg-light text-right p-2">
                    <button type="submit" class="btn btn-success btn-md">
                        Lihat Hasil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
