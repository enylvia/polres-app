<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function dashboard() {
        return view ('dashboard.index');
    }
    function index()
    {
        return view('sesi.index');
    }
    function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ], [
                'email.required' => 'email wajib diisi',
                'password.required' => 'password wajib diisi',
            ]
        );

        $infologin = [
            'email' =>$request->email,
            'password' =>$request->password,
        ];
        if (Auth::attempt($infologin)) {
            return redirect('/admin/index')->with('success','Anda Berhasil Login');
        } else{
            return redirect('sesi')->withErrors('Username dan Password yang dimasukan tidak valid');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('sesi')->with('success', 'Berhasil Logout');
    }

    function register(){
        return view('sesi.register');
    }
    function create(Request $request){
        Session::flash('name', $request->name);
        Session::flash('nik', $request->nik);
        Session::flash('email', $request->email);
        $request->validate(
            [
                'name' => 'required',
                'nik' => 'required|min:16',
                'phone_number' => 'required|min:10',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ], [
                'name.required' => 'Nama wajib diisi',
                'nik.required' => 'Nik wajib diisi',
                'nik.min' => 'Minimum NIK berjumlah 16 karakter',
                'phone_number.required' => 'Nomor Telepon wajib diisi',
                'phone_number.min' => 'Minimum Nomor Telepon berjumlah 10',
                'email.required' => 'email wajib diisi',
                'email.email' => 'Silahkan masukan email yang valid',
                'email.unique' => 'Email sudah pernah digunakan, silahkan pilih email yang lain',
                'password.required' => 'password wajib diisi',
                'password.min' => 'Minimum password yang dimasukan 6 karakter',
            ]
        );

        $data = [
            'name' =>$request->name,
            'nik' =>$request->nik,
            'phone_nnumber' =>$request->phone_number,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
        ];
        User::create($data);

        $infologin = [
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>$request->password,
        ];
        if (Auth::attempt($infologin)) {
            return redirect('/admin/index')->with('success', Auth::user()->name. 'Anda Berhasil Login');
        } else{
            return redirect('sesi')->withErrors('Username dan Password yang dimasukan tidak valid');
        }
    }
}
