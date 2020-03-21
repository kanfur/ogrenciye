<?php

namespace App\Http\Controllers\Api\v1;

use App\Model\StudentDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function createDocument(Request $request){
        try {
            $user = auth()->user();

            if(!$user){
                return response()->json(['error'=>'User bulunamadı !','message'=>'Login olduğunuza emin olunuz!'],403);
            }

            $this->validate($request, [
                'photo' => 'required',
                'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            if ($request->file('photo')) {
                $image = $request->file('photo');
                //dd($request->file('photos'));
                $flag = true;
                if($image->isValid()){
                    $photo = new StudentDocument();
                    $photo->user_id = $user->id;
                    $photo->filename = $image->getClientOriginalName();
                    $photo->extension = $image->extension();
                    $photo->size_kb = $image->getSize()/1024;
                    $image->move(public_path().'/images/s_p/'.strstr($user->email, '@', true).'/', $photo->filename);
                    $photo->mime_type = MimeType::get($photo->extension);
                    $photo->path = '/images/s_p/'.strstr($user->email, '@', true).'/'.$photo->filename;
                    $photo->save();
                    $flag = false;
                }else{
                    return response()->json(['error'=>'Resim yüklenemedi !'],401);
                }
                if($flag){
                    return response()->json(['error'=>'Flag true döndü ! Bizi bilgilendirin'],401);
                }
            }else{
                return response()->json(['error'=>'Photos keyi bulunamadı !'],401);
            }
        } catch (ValidationException $e) {
            return response()->json(['error'=>'Bir hata meydana geldi !'. $e->getMessage()],401);
        }
        return response()->json(['success'=>true,'message'=>'Öğrenci doğrulama belgeniz yüklendi'],200);
    }
}
