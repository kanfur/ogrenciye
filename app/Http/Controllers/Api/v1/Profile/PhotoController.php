<?php

namespace App\Http\Controllers\Api\v1\Profile;

use App\Http\Resources\UserResource;
use App\Model\User;
use App\Model\UserPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Validation\ValidationException;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json(['error'=>'User bulunamadı ! Login olduğunuza emin olunuz !'],403);
        }
        try {
            $this->validate($request, [
                'photo' => 'required',
                'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            if ($request->file('photo')) {
                $image = $request->file('photo');
                //dd($request->file('photos'));
                $flag = true;
                if($image->isValid()){
                    //$photo = new UserPhoto();
                    //$photo->restaurant_id = $user->id;
                    $filename = $image->getClientOriginalName();
                    $extension = $image->extension();
                    //$photo->_order = 0;
                    //$photo->size_kb = $image->getSize()/1024;
                    $fullPath = $image->move(public_path().'/images/p_p/'.strstr($user->email, '@', true).'/', $filename);
                    //$photo->mime_type = MimeType::get($photo->extension);
                    $path = '/images/p_p/'.strstr($user->email, '@', true).'/'.$filename;
                    //$photo->save();*/
                    $user->photo = $path;
                    $user->save();
                    $flag = false;
                }else{
                    return response()->json(['error'=>'Resim yüklenemedi !'],401);
                }
                if($flag){
                    return response()->json(['error'=>'Bir hata oluştu ! Bizi bilgilendirin'],401);
                }
            }else{
                return response()->json(['error'=>'Photo keyi bulunamadı !'],401);
            }
        } catch (ValidationException $e) {
            return response()->json(['error'=>'Bir hata meydana geldi !'],401);
        }
        return new UserResource($user);
    }
}
