@extends('layout.master')

@section('activekuKelulusan')
    activeku
@endsection

@section('judul')
    <i class="fa fa-graduation-cap"></i> Data Kelulusan
@endsection
@section('headers')
<style>
.tags-input-wrapper{
    background: transparent;
    padding: 10px;
    border-radius: 4px;
    max-width: 100%;
    border: 1px solid #ccc;
}
.tags-input-wrapper input{
    border: none;
    background: transparent;
    outline: none;
    width: 140px;
    margin-left: 8px;
}
.tags-input-wrapper .tag{
    display: inline-block;
    background-color: #fa0e7e;
    color: white;
    font-weight: bold;
    border-radius: 40px;
    padding: 0px 3px 0px 7px;
    margin-right: 5px;
    margin-bottom:5px;
    box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7)
}
.tags-input-wrapper .tag a {
    margin: 0 7px 3px;
    display: inline-block;
    cursor: pointer;
}
</style>


@endsection

@section('content')
<script>
    (function () {
        "use strict";

        // Plugin Constructor
        var TagsInput = function (opts) {
        this.options = Object.assign(TagsInput.defaults, opts);
        this.init();
        };

        // Initialize the plugin
        TagsInput.prototype.init = function (opts) {
        this.options = opts ? Object.assign(this.options, opts) : this.options;

        if (this.initialized) this.destroy();

        if (
            !(this.orignal_input = document.getElementById(this.options.selector))
        ) {
            console.error(
            "tags-input couldn't find an element with the specified ID"
            );
            return this;
        }

        this.arr = [];
        this.wrapper = document.createElement("div");
        this.input = document.createElement("input");
        init(this);
        initEvents(this);

        this.initialized = true;
        return this;
        };

        // Add Tags
        TagsInput.prototype.addTag = function (string) {
        if (this.anyErrors(string)) return;

        this.arr.push(string);
        var tagInput = this;

        var tag = document.createElement("span");
        tag.className = this.options.tagClass;
        tag.innerText = string;

        var closeIcon = document.createElement("a");
        closeIcon.innerHTML = "&times;";

        // delete the tag when icon is clicked
        closeIcon.addEventListener("click", function (e) {
            e.preventDefault();
            var tag = this.parentNode;

            for (var i = 0; i < tagInput.wrapper.childNodes.length; i++) {
            if (tagInput.wrapper.childNodes[i] == tag) tagInput.deleteTag(tag, i);
            }
        });

        tag.appendChild(closeIcon);
        this.wrapper.insertBefore(tag, this.input);
        this.orignal_input.value = this.arr.join(",");

        return this;
        };

        // Delete Tags
        TagsInput.prototype.deleteTag = function (tag, i) {
        tag.remove();
        this.arr.splice(i, 1);
        this.orignal_input.value = this.arr.join(",");
        return this;
        };

        // Make sure input string have no error with the plugin
        TagsInput.prototype.anyErrors = function (string) {
        if (this.options.max != null && this.arr.length >= this.options.max) {
            console.log("max tags limit reached");
            return true;
        }

        if (!this.options.duplicate && this.arr.indexOf(string) != -1) {
            console.log('duplicate found " ' + string + ' " ');
            return true;
        }

        return false;
        };

        // Add tags programmatically
        TagsInput.prototype.addData = function (array) {
        var plugin = this;

        array.forEach(function (string) {
            plugin.addTag(string);
        });
        return this;
        };

        // Get the Input String
        TagsInput.prototype.getInputString = function () {
        return this.arr.join(",");
        };

        // destroy the plugin
        TagsInput.prototype.destroy = function () {
        this.orignal_input.removeAttribute("hidden");

        delete this.orignal_input;
        var self = this;

        Object.keys(this).forEach(function (key) {
            if (self[key] instanceof HTMLElement) self[key].remove();

            if (key != "options") delete self[key];
        });

        this.initialized = false;
        };

        // Private function to initialize the tag input plugin
        function init(tags) {
        tags.wrapper.append(tags.input);
        tags.wrapper.classList.add(tags.options.wrapperClass);
        tags.orignal_input.setAttribute("hidden", "true");
        tags.orignal_input.parentNode.insertBefore(
            tags.wrapper,
            tags.orignal_input
        );
        }

        // initialize the Events
        function initEvents(tags) {
        tags.wrapper.addEventListener("click", function () {
            tags.input.focus();
        });

        tags.input.addEventListener("keydown", function (e) {
            var str = tags.input.value.trim();

            if (!!~[9, 13, 188].indexOf(e.keyCode)) {
            e.preventDefault();
            tags.input.value = "";
            if (str != "") tags.addTag(str);
            }
        });
        }

        // Set All the Default Values
        TagsInput.defaults = {
        selector: "",
        wrapperClass: "tags-input-wrapper",
        tagClass: "tag",
        max: null,
        duplicate: false
        };

        window.TagsInput = TagsInput;
    })();
</script>

<form action="{{ url()->current() }}" class="">
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <div class='form-group'>
                    <select name='jurusan' id='forjurusan' onchange="submit()" class='form-control'>
                        <option value=''>Pilih Jurusan</option>
                        @foreach ($jurusan as $item)
                        <option value='{{$item->idjurusan}}' @if ($item->idjurusan==$pjur)
                            selected
                        @endif>{{$item->jurusan}}</option>

                        @endforeach
                    <select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">

            <div class="input-group mb-3" class="justify-content-end">
                <input type="text" class="form-control" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" name="keyword" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>

        </div>
    </div>
</form>

    <div class="card">
        <div class="card-body pt-2">
            @error('buku')
                <div class="alert alert-danger" role="alert">
                    Terjadi Kesalahan, judul buku tidak boleh kosong
                </div>
            @enderror
            @error('spp')
                <div class="alert alert-danger" role="alert">
                    Terjadi Kesalahan, nominal SPP tidak boleh kosong
                </div>
            @enderror
                <div class="row">
                    <div class="col-6 text-bold">
                        <h4 class="text-bold">LULUS : {{$hitung}}%</h4>
                    </div>
                    @if (Session::get('posisi')==='tu')
                    <div class="col-6 text-right">
                        <form action="{{ route('kelulusan.lulus.reset', []) }}" method="post" class="d-inline" onclick="return confirm('Yakin ingin reset kelulusan?')">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-md mb-2" type="submit" title="reset kelulusan">
                                <i class="fa fa-recycle"></i> Rest. Kelulusan
                            </button>
                        </form>

                        <form action="{{ route('kelulusan.lulus.semua', []) }}" method="post" onclick="return confirm('Yakin ingin meluluskan semua?')" class="d-inline">
                            @csrf
                            <button class="btn btn-secondary btn-md mb-2" type="submit">
                                <i class="fa fa-graduation-cap"></i> LULUSKAN SEMUA
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        @if (Session::get('posisi')==='perpus')
                        <th>Perpus</th>
                        @endif
                        @if (Session::get('posisi')==='tu')
                        <th>SPP</th>
                        <th>Ket</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach ($siswa as $s)
                    <tr>
                        <td nowrap width="4px">{{$loop->iteration + $siswa->firstItem() - 1}}</td>
                        <td nowrap class="text-capitalize">{{$s->nama}}</td>
                        <td>{{$s->jurusan}}</td>
                        @php
                            $dataku1 = DB::table('tunggakanbuku')->where('nisn', $s->nisn)->count();
                            $dataku = DB::table('tunggakanbuku')->where('nisn', $s->nisn)->first();
                            $addData = empty($dataku->judulbuku)?null:$dataku->judulbuku;
                            if($addData != null) {
                                $addData = explode(',',$addData) ;
                            }

                            $addData = json_encode($addData);
                        @endphp
                        @if (Session::get('posisi')==='perpus')

                        <td nowrap width="5% ">
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary py-1 px-3 border-0 dinline" data-toggle="modal" data-target="#books{{$s->nisn}}">
                               <i class="fa fa-books"></i> KEL. PERPUS
                            </button>

                            @if ($dataku1 > 0)
                                <form action="{{ route('kelulusan.buku.hapus', [$s->nisn]) }}" method="post" class="d-inline" title="Kelola Tunggakan Perpustakaan">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge badge-danger py-1 border-0" type="submit" onclick="return confirm('yakin ingin menghapus data buku?')" title="selesaikan Perpus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @endif

                        </td>
                        @endif

                        @if (Session::get('posisi')==='tu')

                        <td nowrap width="5% ">
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary py-1 px-3 border-0 dinline" data-toggle="modal" data-target="#SPP{{$s->nisn}}" title="Kelola Tunggakan SPP">
                                <i class="fa fa-dollar"></i> KEL.SPP
                            </button>
                            @php
                                $dataku2 = DB::table('tunggakanspp')->where('nisn', $s->nisn)->count();
                                $datakuspp = DB::table('tunggakanspp')->where('nisn', $s->nisn)->first();
                                $addDataspp = empty($datakuspp->spp)?null:$datakuspp->spp;
                            @endphp

                            @if ($dataku2 > 0)
                                <form action="{{ route('kelulusan.spp.hapus', [$s->nisn]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge badge-danger py-1 border-0" type="submit" onclick="return confirm('yakin ingin menghapus data spp?')" title="selesaikan SPP">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                        @php
                            // -----------------------------
                            // kelulusan
                            $lulus = DB::table('kelulusan')->where('nisn', $s->nisn)->count();
                            if($lulus>0) {
                                $lulus = DB::table('kelulusan')->where('nisn', $s->nisn)->first();
                                $lulus = $lulus->ket;
                            }else {
                                $lulus = "none";
                            }
                        @endphp

                        <td nowrap width="7%">
                            <form action="{{ route('kelulusan.lulus', [$s->nisn]) }}" method="post">
                                @csrf
                                <div class='form-group mb-0'>
                                    <select name='lulus' required id='forlulus' class='form-control' onchange="submit()" style="width:130px;height: 25px;padding: 0">
                                        <option value=''>Pilih</option>
                                        <option value='lulus' @if ($lulus=="lulus")
                                            selected
                                        @endif>Lulus</option>
                                        <option value='tidak lulus' @if ($lulus=="tidak lulus")
                                            selected
                                        @endif>Tidak Lulus</option>
                                    <select>
                                </div>
                            </form>
                        </td>
                        @endif

                    </tr>

                    <!-- Modal -->
                    @if (Session::get('posisi')==='tu')
                    <div class="modal fade" id="SPP{{$s->nisn}}" tabindex="-1" role="dialog" aria-labelledby="SPP" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">NISN: {{$s->nisn}} | SPP</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('kelulusan.spp', [$s->nisn]) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <font class="text-red"><p>Data SPP yang belum diselesaikan</p></font>

                                        <div class='form-group'>
                                            <label for='forspp' class='text-capitalize'>Tunggakan SPP (RP)</label>
                                            <input type='text' name='spp' id='rupiah{{$s->nisn}}' class='form-control' placeholder='1-99999999'>
                                        </div>

                                        <h5>Rp{{number_format($addDataspp,0,".",".")}}</h5>


                                        <script>
                                            var rupiah{{$s->nisn}} = document.getElementById("rupiah{{$s->nisn}}");
                                            rupiah{{$s->nisn}}.addEventListener("keyup", function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rupiah{{$s->nisn}}.value = formatRupiah(this.value, "Rp. ");
                                            });

                                            /* Fungsi formatRupiah */
                                            function formatRupiah(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                                                split = number_string.split(","),
                                                sisa = split[0].length % 3,
                                                rupiah{{$s->nisn}} = split[0].substr(0, sisa),
                                                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan) {
                                                separator = sisa ? "." : "";
                                                rupiah{{$s->nisn}} += separator + ribuan.join(".");
                                            }

                                            rupiah{{$s->nisn}} = split[1] != undefined ? rupiah{{$s->nisn}} + "," + split[1] : rupiah{{$s->nisn}};
                                            return prefix == undefined ? rupiah{{$s->nisn}} : rupiah{{$s->nisn}} ? "Rp" + rupiah{{$s->nisn}} : "";
                                            }
                                        </script>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (Session::get('posisi')==='perpus')
                    <!-- Modal -->
                    <div class="modal fade" id="books{{$s->nisn}}" tabindex="-1" role="dialog" aria-labelledby="books" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">NISN: {{$s->nisn}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('kelulusan.buku', [$s->nisn]) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <font class="text-red"><p>Data buku yang belum diselesaikan, isi data buku lalu <b>ENTER</b></p></font>
                                        <div class='form-group'>
                                            <label for='fornama' class='text-capitalize'>Judul Buku</label>
                                            <input type="text" name="buku" id="tag-input1{{$s->nisn}}" placeholder="masukan data buku">
                                        </div>




                                        <script>
                                            var tagInput{{$s->nisn}} = new TagsInput({
                                            selector: "tag-input1{{$s->nisn}}",
                                            duplicate: false,
                                            max: 20
                                            });
                                            tagInput{{$s->nisn}}.addData(@php
                                                echo $addData;
                                            @endphp);

                                        </script>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{$siswa->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>


@endsection

@section('footers')

@endsection
