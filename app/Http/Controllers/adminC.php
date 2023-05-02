<?php

namespace App\Http\Controllers;

use App\Models\adminM;
use Illuminate\Http\Request;
use Hash;

class adminC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin = adminM::get();

        return view('pages.pagesAdmin', [
            'admin' => $admin,
        ]);
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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'posisi' => 'required',
        ]);


        try{
            $username = $request->username;
            $password = Hash::make($request->password);
            $posisi = $request->posisi;

            $store = new adminM;
            $store->username = $username;
            $store->password = $password;
            $store->posisi = $posisi;
            $store->save();
            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function show(adminM $adminM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function edit(adminM $adminM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminM $adminM, $idadminkelulusan)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'posisi' => 'required',
        ]);


        try{
            $password = Hash::make($request->password);
            $posisi = $request->posisi;
            $username = $request->username;

            $update = adminM::where('idadminkelulusan', $idadminkelulusan)
            ->where('username', $username)
            ->update([
                'password' => $password,
                'posisi' => $posisi,
            ]);
            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminM $adminM, $idadminkelulusan)
    {
        try{
            $destroy = adminM::where('idadminkelulusan', $idadminkelulusan)->delete();
            if($destroy) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
