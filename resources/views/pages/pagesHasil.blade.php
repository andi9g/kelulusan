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

<div class="row mt-4">
    <div class="col-md-3"></div>
    <div class="col-md-6 mb-5">
        <a href="{{ url('/', []) }}" class="btn btn-sm btn-danger"><< Kembali</a>
        @if ($buka===true)
        <div class="card m-2">
            <div class="card-header bg-light">
                <h5 class="m-0" class="text-bold"><b>IDENTITAS</b></h5>
            </div>
            <div class="card-body" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">

                    <table class="table table-striped text-bold table-md">
                        <tr>
                            <td width="3%">NISN</td>
                            <td width="1px">:</td>
                            <td>{{$data->nisn}}</td>
                        </tr>
                        <tr>
                            <td width="3%">Nama</td>
                            <td width="1px">:</td>
                            <td valign="top">{{strtoupper($data->nama)}}</td>
                        </tr>
                        <tr>
                            <td width="3%">Jurusan</td>
                            <td width="1px">:</td>
                            <td valign="top">{{strtoupper($data->namajurusan)}}</td>
                        </tr>
                        <tr>
                            <td width="3%">Alamat</td>
                            <td width="1px">:</td>
                            <td valign="top">{{strtoupper($data->alamat)}}</td>
                        </tr>
                    </table>




            </div>
            {{-- <div class="card-footert bg-secondary p-2"> --}}

            {{-- </div> --}}
        </div>


        @php
            $perpus = DB::table('tunggakanbuku')->where('nisn', $data->nisn);
        @endphp
        @if ($perpus->count()>0)
            @php
                $perpus = $perpus->first();
                $ex = explode(",", $perpus->judulbuku);
                $i=1;
            @endphp
            <div class="card m-2 mt-4">
                <div class="card-header bg-light">
                    <h5 class="m-0" class="text-bold"><b>PERPUSTAKAAN</b></h5>
                </div>
                <div class="card-body" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                        <font class="text-danger"><p>Harap menyelesaikan permasalahan pada perpustakaan...</p></font>
                        <table class="table table-striped text-bold table-sm table-bordered">
                            <tr>
                                <th width="1px">No</th>
                                <th>Judul Buku</th>
                            </tr>
                            @foreach ($ex as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{strtoupper($item)}}</td>
                            </tr>

                            @endforeach

                        </table>


                </div>
                {{-- <div class="card-footert bg-secondary p-2"> --}}

                {{-- </div> --}}
            </div>

        @endif


        @php
            $spp = DB::table('tunggakanspp')->where('nisn', $data->nisn);
        @endphp
        @if ($spp->count()>0)
            @php
                $spp = $spp->first();

            @endphp
            <div class="card m-2 mt-4">
                <div class="card-header bg-light">
                    <h5 class="m-0" class="text-bold"><b>TATA USAHA</b></h5>
                </div>
                <div class="card-body" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                        <font class="text-danger"><p class="my-0 py-0">Harap menyelesaikan Pembayaran Sekolah...</p></font>
                        <p class="my-0 py-1">Tunggakan Sebesar: </p>
                        <h3 class="my-0 py-0">Rp{{number_format($spp->spp, 0,",",".")}}</h3>


                </div>
                {{-- <div class="card-footert bg-secondary p-2"> --}}

                {{-- </div> --}}
            </div>

        @endif

        @php
            $kelulusan = DB::table('kelulusan')->where('nisn', $data->nisn);
        @endphp
        @if ($kelulusan->count()>0)
            @php
                $kelulusan = $kelulusan->first();

            @endphp
            <div class="card m-2 mt-4">
                <div class="card-header bg-light">
                    <h5 class="m-0" class="text-bold"><b>KETERANGAN</b></h5>
                </div>
                <div class="card-body" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">

                        <p class="my-0 py-1">Dinyatakan : </p>
                        <h1 class="my-0 py-0 text-success text-bold text-center">
                            @if ($kelulusan->ket=="lulus")
                                <font class="text-success">{{strtoupper($kelulusan->ket)}}</font>
                            @else
                                <font class="text-danger">{{strtoupper($kelulusan->ket)}}</font>
                            @endif
                        </h1>


                </div>
                {{-- <div class="card-footert bg-secondary p-2"> --}}

                {{-- </div> --}}
            </div>

        @endif


        @else
        <div class="card m-2">
            <div class="card-header bg-light">
                <h5 class="m-0" class="text-bold"><b>PERHATIAN</b></h5>
            </div>
            <div class="card-body" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                    <h3 class="my-0 py-0 text-bold">Hasil Kelulusan Belum Dibuka.</h3>
                    <h4 class="my-0 py-0">Dibuka Pada :</h4>
                    <h3 class="my-0 py-0 text-success text-bold">
                        {{\Carbon\Carbon::parse($open)->isoFormat('dddd, DD MMMM Y')}}
                    </h3>
                    <h3 class="my-0 py-0">
                        <font class="text-dark">Jam : </font>
                        <font class="text-success text-bold">{{date('H.i', $open)}}</font>
                    </h3>
                </div>
                {{-- <div class="card-footert bg-secondary p-2"> --}}

                {{-- </div> --}}
            </div>
        @endif



    </div>
</div>

@endsection
