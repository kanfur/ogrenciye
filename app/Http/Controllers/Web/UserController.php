<?php

namespace App\Http\Controllers\Web;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(12);

        return view('admin.users',compact('users'));
    }
}
