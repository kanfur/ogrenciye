<?php

namespace App\Http\Controllers\Api\v1;

use App\Model\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function save(Request $request){
        $user_id = auth()->id();
        if(!$request->message){
            return response()->json(['error'=>'Mesajınızı girmelisiniz !']);
        }
        try{
            Contact::updateOrCreate([
                'user_id' => $user_id,
                'fullname'=> $request->fullname,
                'phone'=> $request->phone,
                'email'=> $request->email,
                'title'=> $request->title,
                'message'=> $request->message,
            ]);
            return response()->json(['success'=> true, 'message' => 'Mesajınız gönderildi. Teşekkür ederiz']);
        }catch (\Exception $e){
            //TODO loglama yapılmalı
            return response()->json(['error'=>'Bir hata meydana geldi ! Lütfen bizi bilgilendiriniz.']);
        }
    }
}
