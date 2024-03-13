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
}
