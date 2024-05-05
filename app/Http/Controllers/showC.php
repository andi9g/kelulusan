<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\kelulusan;
use App\Models\pengaturanM;
use App\Models\spp;
use App\Models\buku;
use Illuminate\Http\Request;

class showC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function root()
    {
        return redirect('show');
    }
    public function index(Request $request)
    {
        $siswa = siswa::join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
        ->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->where('kelas.kelas', 'XII')
        ->select('siswa.idsiswa', 'siswa.nama')
        ->get();
        return view('pages.pagesShow1', [
            'siswa' => $siswa,
        ]);
    }

    public function lihatlulus(Request $request)
    {
        $request->validate([
            'siswa'=>'required',
            // 'nisn'=>'required',
            'passid'=>'required',
        ]);

        try{
            $idsiswa = $request->siswa;
            $nisn = $request->nisn;
            $passid = $request->passid;

            $open = strtotime(pengaturanM::first()->open);
            $tanggal = strtotime(date('Y-m-d H:i'));
            $buka = false;
            if($open <= $tanggal) {
                $buka = true;
            }

            $cek = siswa::join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
            ->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
            ->where('kelas.kelas', 'XII')
            ->select('siswa.*', 'jurusan.namajurusan')
            ->where('siswa.idsiswa', $idsiswa)->where('siswa.nis', $passid);

            if($cek->count()===1){
                $data = $cek->first();
            }else{
                return redirect()->back()->with('warning', 'Maaf, data tidak valid');
            }

            return view('pages.pagesHasil', [
                'buka' => $buka,
                'data' => $data,
                'open' => $open,
            ]);



        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function datakelulusan(Request $request)
    {

        try{

            $open = strtotime(pengaturanM::first()->open2);
            $tanggal = strtotime(date('Y-m-d H:i'));
            $buka = false;
            if($open <= $tanggal) {
                $buka = true;
            }

            $jumlahsiswa = siswa::join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
            ->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
            ->where('kelas.kelas', 'XII')->count();
            $lulus = kelulusan::where('ket', 'lulus')->count();

            $hitung = $lulus / $jumlahsiswa * 100;

            return view('pages.pagesHasilKeseluruhan', [
                'buka' => $buka,
                'open' => $open,
                'hitung' => $hitung,
            ]);



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
