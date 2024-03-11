<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::where('id_user',Auth::id())->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    // Menyimpan kendaraan baru ke database
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
        }else {
            return redirect('/user/create_data_kendaraan')
                ->with('errors', 'Unauthorized!');
        }
        // Validasi input
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string',
            'model' => 'required|string',
            'warna' => 'required|string',
            'nomor_polisi' => 'required|string',
            'no_rangka' => 'required|string',
            'no_mesin' => 'required|string',
            'scan_bpkb' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scan_stnk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_ktp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kendaraan' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('kendaraan/create')
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat nama file yang random untuk disimpan
        $scan_bpkbFileName = null;
        $scan_stnkFileName = null;
        $foto_ktpFileName = null;
        $foto_kendaraanFileName = null;
        $scan_bpkbPath = null;
        $scan_stnkPath = null;
        $foto_ktpPath = null;
        $foto_kendaraanPath = null;

        // Menyimpan gambar ke storage dan mendapatkan path jika file tidak null
        if ($request->hasFile('scan_bpkb')) {
            $scan_bpkbFileName = Str::random(20) . '.' . $request->file('scan_bpkb')->getClientOriginalExtension();
            $scan_bpkbPath = $request->file('scan_bpkb')->storeAs('public/scan_bpkb', $scan_bpkbFileName);
            $scan_bpkbUrl = Storage::url($scan_bpkbPath);
        }

        if ($request->hasFile('scan_stnk')) {
            $scan_stnkFileName = Str::random(20) . '.' . $request->file('scan_stnk')->getClientOriginalExtension();
            $scan_stnkPath = $request->file('scan_stnk')->storeAs('public/scan_stnk', $scan_stnkFileName);
            $scan_stnkUrl = Storage::url($scan_stnkPath);
        }

        if ($request->hasFile('foto_ktp')) {
            $foto_ktpFileName = Str::random(20) . '.' . $request->file('foto_ktp')->getClientOriginalExtension();
            $foto_ktpPath = $request->file('foto_ktp')->storeAs('public/foto_ktp', $foto_ktpFileName);
            $foto_ktpUrl = Storage::url($foto_ktpPath);
        }

        if ($request->hasFile('foto_kendaraan')) {
            $foto_kendaraanFileName = Str::random(20) . '.' . $request->file('foto_kendaraan')->getClientOriginalExtension();
            $foto_kendaraanPath = $request->file('foto_kendaraan')->storeAs('public/foto_kendaraan', $foto_kendaraanFileName);
            $foto_kendaraanUrl = Storage::url($foto_kendaraanPath);
        }

        // Menyimpan data kendaraan ke database
        Kendaraan::create([
            'id_user' => $user_id,
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'nomor_polisi' => $request->nomor_polisi,
            'no_rangka' => $request->no_rangka,
            'no_mesin' => $request->no_mesin,
            'scan_bpkb' => $scan_bpkbUrl,
            'scan_stnk' => $scan_stnkUrl,
            'foto_ktp' => $foto_ktpUrl,
            'foto_kendaraan' => $foto_kendaraanUrl,
        ]);


        return redirect('/user/data_kendaraan')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    // Menampilkan detail kendaraan
    public function show($id)
    {
        $kendaraan = Kendaraan::find($id);
        return view('kendaraan.detail', compact('kendaraan'));
    }

    // Menampilkan form untuk mengedit kendaraan
    public function edit($id)
    {
        $kendaraan = Kendaraan::find($id);
        return view('kendaraan.edit', compact('kendaraan'));
    }

    // Menyimpan perubahan kendaraan ke database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string',
            'model' => 'required|string',
            'warna' => 'required|string',
            'nomor_polisi' => 'required|string',
            'no_rangka' => 'required|string',
            'no_mesin' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect("kendaraan/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $kendaraan = Kendaraan::find($id);
        $kendaraan->update([
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'nomor_polisi' => $request->nomor_polisi,
            'no_rangka' => $request->no_rangka,
            'no_mesin' => $request->no_mesin,
        ]);

        if ($request->hasFile('scan_bpkb')) {
            Storage::delete($kendaraan->scan_bpkb);
            $scan_bpkbFileName = Str::random(20) . '.' . $request->file('scan_bpkb')->getClientOriginalExtension();
            $scan_bpkbPath = $request->file('scan_bpkb')->storeAs('public/scan_bpkb', $scan_bpkbFileName);
            $scan_bpkbUrl = Storage::url($scan_bpkbPath);
            $kendaraan->update(['scan_bpkb' => $scan_bpkbUrl]);
        }

        if ($request->hasFile('scan_stnk')) {
            Storage::delete($kendaraan->scan_stnk);
            $scan_stnkFileName = Str::random(20) . '.' . $request->file('scan_stnk')->getClientOriginalExtension();
            $scan_stnkPath = $request->file('scan_stnk')->storeAs('public/scan_stnk', $scan_stnkFileName);
            $scan_stnkUrl = Storage::url($scan_stnkPath);
            $kendaraan->update(['scan_stnk' => $scan_stnkUrl]);
        }

        if ($request->hasFile('foto_ktp')) {
            Storage::delete($kendaraan->foto_ktp);
            $foto_ktpFileName = Str::random(20) . '.' . $request->file('foto_ktp')->getClientOriginalExtension();
            $foto_ktpPath = $request->file('foto_ktp')->storeAs('public/foto_ktp', $foto_ktpFileName);
            $foto_ktpUrl = Storage::url($foto_ktpPath);
            $kendaraan->update(['foto_ktp' => $foto_ktpUrl]);
        }

        if ($request->hasFile('foto_kendaraan')) {
            Storage::delete($kendaraan->foto_kendaraan);
            $foto_kendaraanFileName = Str::random(20) . '.' . $request->file('foto_kendaraan')->getClientOriginalExtension();
            $foto_kendaraanPath = $request->file('foto_kendaraan')->storeAs('public/foto_kendaraan', $foto_kendaraanFileName);
            $foto_kendaraanUrl = Storage::url($foto_kendaraanPath);
            $kendaraan->update(['foto_kendaraan' => $foto_kendaraanUrl]);
        }

        return redirect('/user/data_kendaraan')->with('success', 'Kendaraan berhasil diperbarui!');
    }

    // Menghapus kendaraan dari database
    public function destroy($id)
    {
        $kendaraan = Kendaraan::find($id);

        // Menghapus gambar dari storage
        Storage::delete([$kendaraan->scan_bpkb, $kendaraan->scan_stnk, $kendaraan->foto_ktp, $kendaraan->foto_kendaraan]);

        // Menghapus kendaraan dari database
        $kendaraan->delete();

        return redirect()->back()->with('success', 'Kendaraan berhasil dihapus!');
    }
}
