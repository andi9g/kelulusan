<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\jurusan;
use App\Models\buku;
use App\Models\kelulusan;
use App\Models\spp;
use Illuminate\Http\Request;

class kelulusanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurusan = empty($request->jurusan)?"":$request->jurusan;
        $keyword = empty($request->keyword)?"":$request->keyword;

        $djurusan = jurusan::get();

        $siswa = siswa::join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
        ->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->where('kelas.kelas', 'XII')
        ->where(function ($query) use ($keyword){
            $query->where('siswa.nama', 'like', "%$keyword%");
        })
        ->select('jurusan.jurusan', 'siswa.*')
        ->where('jurusan.idjurusan', 'like', "$jurusan%")
        ->paginate(15);

        $jumlahsiswa = siswa::join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
        ->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->where('kelas.kelas', 'XII')->count();
        $lulus = kelulusan::where('ket', 'lulus')->count();

        $hitung = $lulus / $jumlahsiswa * 100;

        // dd(siswa::get());
        $siswa->appends($request->only(["limit",'keyword','jurusan']));

        return view('pages.pagesKelulusan', [
            'siswa' => $siswa,
            'jurusan' => $djurusan,
            'pjur' => $jurusan,
            'hitung' => $hitung,
        ]);
    }

    public function hapusbuku(Request $request, $nisn)
    {
        try{
            $destroy = buku::where('nisn', $nisn)->delete();
            if($destroy) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function buku(Request $request, $nisn)
    {
        $request->validate([
            'buku' => 'required',
        ]);


        try{
            $judulbuku = $request->buku;
            buku::where('nisn', $nisn)->delete();

            $store = new buku;
            $store->nisn = $nisn;
            $store->judulbuku = $judulbuku;
            $store->save();

            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapusspp(Request $request, $nisn)
    {
        try{
            $destroy = spp::where('nisn', $nisn)->delete();
            if($destroy) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function spp(Request $request, $nisn)
    {
        $request->validate([
            'spp' => 'required',
        ]);


        try{
            $spp = str_replace("Rp", "",$request->spp);
            $spp = str_replace(".", "",$spp);
            $spp = (int)$spp;

            spp::where('nisn', $nisn)->delete();

            $store = new spp;
            $store->nisn = $nisn;
            $store->spp = $spp;
            $store->save();

            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function lulus(Request $request, $nisn)
    {
        $request->validate([
            'lulus' => 'required',
        ]);


        try{
            $lulus = $request->lulus;

            kelulusan::where('nisn', $nisn)->delete();

            $store = new kelulusan;
            $store->nisn = $nisn;
            $store->ket = $lulus;
            $store->save();

            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function lulussemua(Request $request)
    {
        try{

            $siswa = siswa::join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
            ->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
            ->where('kelas.kelas', 'XII')
            ->select('siswa.nisn')
            ->get();

            kelulusan::truncate();
            foreach ($siswa as $sis) {
                $store = new kelulusan;
                $store->nisn = $sis->nisn;
                $store->ket = "lulus";
                $store->save();
            }

            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function lulusreset(Request $request)
    {
        try{

            $delete = kelulusan::truncate();

            if($delete) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswa $siswa)
    {
        //
    }
}
