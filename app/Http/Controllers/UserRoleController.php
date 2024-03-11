<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    //
    public function index(){
        $users = User::where('id_user_role',1)->get();
        return view('user.index',compact('users'));
    }
}
