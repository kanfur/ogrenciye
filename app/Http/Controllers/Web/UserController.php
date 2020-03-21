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
    public function verifyStudents(){
        $users = User::whereHas('education')->paginate(12);

        return view('admin.verifyStudents',compact('users'));
    }
    public function verifyUser($id){
        session()->forget('error');
        session()->forget('success');
        $user = User::find($id);

        $user->isVerified = true;
        if($user->save()){
            session()->put('success', 'Kullanıcı onaylandı');
        }else{
            session()->put('error', 'Bir hata meydana geldi');
        }

        return redirect()
            ->back();
    }
}
