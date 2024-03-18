<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    //
    public function index(){
        $users = User::where('id_user_role',1)->get();
        return view('user.index',compact('users'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit',compact('user'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

       $user = User::find($id);
       $user->password = Hash::make($request->password);
       $user->save();

        return redirect('/admin/data_user')->with('success', 'Password berhasil diperbarui.');
    }
    public function edit_profile($id)
    {
        // Ambil data user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('errors', 'User not found.');
        }

        return view('user.edit_profile', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Ambil data user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('errors', 'User not found.');
        }

        // Update data user
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}
