<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use App\M_Admin;

class Admin extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    // public function adminGenerate()
    // {
    //     M_Admin::create(
    //         [
    //             'nama'  => "Admin",
    //             'email' => "admin@gmail.com",
    //             'alamat' => "Jl. Admin",
    //             'password' => encrypt("admin@gmail.com")
    //         ]
    //     );
    // }

    public function masukAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $cek = M_Admin::where('email', $request->email)->count();
        $adm = M_Admin::where('email', $request->email)->get();

        if ($cek > 0) {
            foreach ($adm as $a) {
                if (decrypt($a->password) == $request->password) {

                    $key = env('APP_KEY');
                    $data = array(
                        'id_admin' => $a->id_admin
                    );

                    $jwt = JWT::encode($data, $key, 'HS256');

                    M_Admin::where('id_admin', $a->id_admin)->update([
                        'token' => $jwt
                    ]);
                    Session::put('token', $jwt);

                    echo "Berhasil Login";
                } else {
                    return redirect('/masukAdmin')->with('gagal', 'Password Salah!');
                }
            }
        } else {
            return redirect('/masukAdmin')->with('gagal', 'Data email tidak terdaftar');
        }
    }
}
