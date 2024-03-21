<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Kendaraan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {

        if (Auth::user()->id_user_role == 1) {
            $countPengguna = User::where('id_user_role', 1)->count();
            $countTotalLaporan = Laporan::where('id_user',Auth::id())->count();
            $countTotalLaporanProses = Laporan::where('id_laporan_status', '2')->where('id_user',Auth::id())->count();
            $countTotalLaporanSelesai = Laporan::where('id_laporan_status', '3')->where('id_user',Auth::id())->count();
        }else{
            $countPengguna = User::where('id_user_role', 1)->count();
            $countTotalLaporan = Laporan::count();
            $countTotalLaporanProses = Laporan::where('id_laporan_status', '2')->count();
            $countTotalLaporanSelesai = Laporan::where('id_laporan_status', '3')->count();
        }
        return view('admin.index', compact('countPengguna', 'countTotalLaporan', 'countTotalLaporanSelesai', 'countTotalLaporanProses'));
    }

    public function index_laporan_user(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
        } else {
            return redirect('/data_laporan')
                ->with('errors', 'Unauthorized!');
        }

        $query = Laporan::with('LaporanStatus','user');

        // Filter berdasarkan nama pengguna
        if ($request->has('search')) {
            $query->join('users', 'laporans.id_user', '=', 'users.id')
                ->select('laporans.*','users.name')
                ->where('users.name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan role pengguna
        if (Auth::user()->id_user_role != 2) {
            $query->where('id_user', $user_id);
        }

        // Ambil data laporan
        $laporans = $query->where('is_arsip', false)->paginate(10);

        return view("laporan.index", compact('laporans'));
    }


    public function index_laporan_arsip()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
        }else {
            return redirect('/data_laporan')
                ->with('errors', 'Unauthorized!');
        }
        if (Auth::user()->id_user_role == 2) {
            $laporans = Laporan::with('LaporanStatus')->where('is_arsip', true)->paginate(10);
        }
        return view("laporan.arsip",compact('laporans'));
    }
    // Menampilkan form untuk membuat laporan baru
    public function create()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
        }else {
            return redirect('/user/create_data_kendaraan')
                ->with('errors', 'Unauthorized!');
        }
        $kendaraans = Kendaraan::where('id_user',$user_id)->get();
        return view('laporan.create', compact('kendaraans'));
    }

    // Menyimpan laporan baru ke database
    public function store(Request $request)
    {
        $date = Carbon::parse(now())->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);

        if (Auth::check()) {
            $user_id = Auth::id();
        }else {
            return redirect('/data_laporan')
                ->with('errors', 'Unauthorized!');
        }
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_kendaraan' => 'required|exists:kendaraans,id',
            'tanggal_laporan' => 'required|date',
            'tanggal_hilang' => 'required|date',
            'deskripsi' => 'required|string',
            'alamat_pelapor' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('/user/create_laporan')
                ->withErrors($validator)
                ->withInput();
        }

        $dates = $date->format('d F Y');
        $tahun = $date->format('Y');
        $namaBulan = $date->format('F');

        $romawiBulan = $this->convertBulanToRomawi($namaBulan);
        $countTotalLaporan = Laporan::count();

        $format_no_laporan = 'LP / B / ' . ($countTotalLaporan + 1) . ' / ' . $romawiBulan . ' / ' . $tahun . ' / RESKRIM / SPKT / POLRES / NABIRE / POLDA PAPUA, ' . $dates;

        // Menyimpan data laporan ke database
        $request->id_user = $user_id;
        $request->no_laporan = $format_no_laporan;

        Laporan::create([
            'id_user' => $request->id_user,
            'id_kendaraan' => $request->id_kendaraan,
            'no_laporan' => $request->no_laporan,
            'tanggal_laporan' => $request->tanggal_laporan,
            'tanggal_hilang' => $request->tanggal_hilang,
            'deskripsi' => $request->deskripsi,
            'alamat_pelapor' => $request->alamat_pelapor,
        ]);


        return redirect('/data_laporan')->with('success', 'Laporan berhasil ditambahkan!');
    }

    // Menampilkan detail laporan
    public function show($id)
    {
        $laporan = Laporan::with('kendaraan','user')->find($id);
        return view('laporan.detail', compact('laporan'));
    }

    // Menampilkan form untuk mengedit laporan
    public function edit($id)
    {
        $laporan = Laporan::find($id);
        $kendaraans = Kendaraan::all();
        return view('laporan.edit', compact('laporan', 'kendaraans'));
    }

    // Menyimpan perubahan laporan ke database
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_kendaraan' => 'required|exists:kendaraans,id',
            'tanggal_laporan' => 'required|date',
            'tanggal_hilang' => 'required|date',
            'deskripsi' => 'required|string',
            'alamat_pelapor' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect("/user/edit_laporan/$id")
                ->withErrors($validator)
                ->withInput();
        }

        // Mengupdate data laporan ke database
        $laporan = Laporan::find($id);
        $laporan->update($request->all());

        return redirect('/data_laporan')->with('success', 'Laporan berhasil diperbarui!');
    }

    // Menghapus laporan dari database
    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        // Menghapus laporan dari database
        $laporan->delete();

        return redirect('/data_laporan')->with('success', 'Laporan berhasil dihapus!');
    }

    public function update_status(Request $request, $id)
    {
        $id_status = $request->id_status;
        $laporan = Laporan::find($id);

        if ($laporan) {
            if ($id_status != 4){

            $laporan->update([
                'id_laporan_status' => $id_status,
                'is_arsip' => false
            ]);
            }else{
                $laporan->update([
                    'id_laporan_status' => 1,
                    'is_arsip' => true,
                ]);
            }

            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }
    }
    function convertBulanToRomawi($namaBulan)
    {
        $romawiBulan = [
            'Januari' => 'I',
            'Februari' => 'II',
            'Maret' => 'III',
            'April' => 'IV',
            'Mei' => 'V',
            'Juni' => 'VI',
            'Juli' => 'VII',
            'Agustus' => 'VIII',
            'September' => 'IX',
            'Oktober' => 'X',
            'November' => 'XI',
            'Desember' => 'XII'
        ];

        return $romawiBulan[$namaBulan] ?? '';
    }

    public function exportToExcel()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }
}
