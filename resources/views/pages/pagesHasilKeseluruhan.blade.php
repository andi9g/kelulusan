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
        @if ($buka===true)

            <div class="card m-2 mt-4">
                <div class="card-header bg-light">
                    <h5 class="m-0" class="text-bold"><b>KETERANGAN LULUS</b></h5>
                </div>
                <div class="card-body" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">

                        <h1 class="my-0 py-0 text-success text-bold text-center">

                            LULUS : <font class="text-success">{{strtoupper($hitung)}}%</font>

                        </h1>


                </div>
                {{-- <div class="card-footert bg-secondary p-2"> --}}

                {{-- </div> --}}
            </div>




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
