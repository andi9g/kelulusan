<?php

namespace App\Http\Controllers;

use App\Models\adminM;
use Illuminate\Http\Request;
use Hash;
use Session;

class loginC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pageslogin');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        try{
            $username = $request->username;
            $password = $request->password;

            $cek = adminM::where('username', $username);
            if($cek->count() === 1) {
                $data = $cek->first();
                if (Hash::check($password, $data->password)) {
                    $request->session()->put('posisi', $data->posisi);
                    $request->session()->put('id', $data->idadminkelulusan);
                    $request->session()->put('username', $data->username);
                    $request->session()->put('login', true);

                    return redirect('kelulusan')->with('success', 'Selamat Datang, Anda Login Sebagai '.strtoupper($data->posisi).'');
                }
            }

            return redirect()->back()->with('toast_error', 'Username atau password tidak benar');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Username atau password tidak benar');
        }
    }

    public function ubahpassword(Request $request)
    {
        $request->validate([
            'password1' => 'required',
            'password2' => 'required',
        ]);


        try{
            $idadminkelulusan = $request->session()->get('id');
            $password1 = $request->password1;
            $password2 = $request->password2;

            if ($password1 === $password2) {
                $password = Hash::make($password1);
            }else {
                return redirect()->back()->with('success', 'Password gagal diubah');
            }

            $update = adminM::where('idadminkelulusan', $idadminkelulusan)->update([
                'password' => $password,
            ]);

            if($update) {
                $request->session()->flush();
                return redirect('login')->with('success', 'Password berhasil dirubah');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
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
    public function update(Request $request, adminM $adminM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminM $adminM)
    {
        //
    }
}
