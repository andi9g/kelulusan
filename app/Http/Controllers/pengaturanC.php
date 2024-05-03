<?php

namespace App\Http\Controllers;

use App\Models\pengaturanM;
use Illuminate\Http\Request;

class pengaturanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cek = pengaturanM::count();
        if($cek == 0) {
            $tambah = new pengaturanM;
            $tambah->open = date('Y-m-d H:i', strtotime("+10 days"));
            $tambah->open2 = date('Y-m-d H:i', strtotime("+10 days"));
            $tambah->save();
        }

        $open = pengaturanM::first();

        return view('pages.pagesPengaturan', [
            'open' => $open,
        ]);
    }

    public function open1(Request $request)
    {
        $request->validate([
            'open' => 'required',
        ]);


        // try{
            $open1 = date('Y-m-d H:i', strtotime($request->open));


            $idpengaturankelulusan = pengaturanM::first()->idpengaturankelulusan;

            $update = pengaturanM::where('idpengaturankelulusan', $idpengaturankelulusan)->update([
                'open' => $open1,
            ]);


            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }

    public function open2(Request $request)
    {
        $request->validate([
            'open2' => 'required',
        ]);


        try{
            $open2 = date('Y-m-d H:i', strtotime($request->open2));


            $idpengaturankelulusan = pengaturanM::first()->idpengaturankelulusan;

            $update = pengaturanM::where('idpengaturankelulusan', $idpengaturankelulusan)->update([
                'open2' => $open2,
            ]);


            if($update) {
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
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function show(pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function edit(pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengaturanM $pengaturanM)
    {
        //
    }
}
