<?php

namespace App\Http\Controllers;

use App\M_Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Response;

class Registrasi extends Controller
{
    public function index()
    {
        return view('registrasi.registrasi');
    }

    public function registrasi(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_usaha'    => 'required',
                'email'         => 'required',
                'alamat'        => 'required',
                'no_npwp'       => 'required',
                'password'      => 'required'
            ]
        );

        if (
            M_Suplier::create(
                [
                    'nama_usaha'    => $request->nama_usaha,
                    'email'         => $request->email,
                    'alamat'        => $request->alamat,
                    'no_npwp'       => $request->no_npwp,
                    'password'      => encrypt($request->password)
                ]
            )

        ) {

            return redirect('/registrasi')->with('berhasil', 'Data berhasil disimpan');
        } else {

            return redirect('/registrasi')->with('gagal', 'Data gagal disimpan');
        }
    }
}
