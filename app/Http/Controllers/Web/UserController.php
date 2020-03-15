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
    public function verifyStudent($id){
        session()->forget('error');
        session()->forget('success');
        $user = User::find($id);
        if($user->isStudent()){
            $user->isVerified = true;
            if($user->save()){
                session()->put('success', 'Öğrenci onaylandı');
            }else{
                session()->put('error', 'Bir hata meydana geldi');
            }
        }else{
            session()->put('error', 'Kullanıcı öğrenci kaydı yapmalıdır !');
        }

        return redirect()
            ->back();
    }
}
