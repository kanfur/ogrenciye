<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\RestaurantDocumentResource;
use App\Http\Resources\RestaurantPhotoResource;
use App\Http\Resources\RestaurantResource;
use App\Model\Restaurant;
use App\Model\RestaurantDocument;
use App\Model\RestaurantPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Validation\ValidationException;

class RestaurantController extends Controller
{
    public function create(Request $request){
        $user = $request->user();

       /* if(!$request->product){
            return response()->json(["error" => "product parametresi gereklidir !"]);
        }
        */
        $restaurant = Restaurant::create([
            'user_id' => $user->id,
            'name'=> $request->name,
            'address'=> $request->address,
            'phone'=> $request->phone,
            'website'=> $request->website,
            'coordinate_x'=>$request->coordinate_x,
            'coordinate_y'=>$request->coordinate_y
        ]);

        return new RestaurantResource($restaurant);
    }
    public function createDocuments(Request $request){
        $user = $request->user();

        $restaurant = RestaurantDocument::updateOrCreate([
            'user_id' => $user->id,
            'restaurant_id'=> $request->restaurant_id,
        ],[
            'user_id' => $user->id,
            'restaurant_id'=> $request->restaurant_id,
            'personnel'=> $request->personnel,
            'title'=> $request->title,
            'address'=> $request->address,
            'tax_administration'=> $request->tax_administration,
            'tax_no'=> $request->tax_no,
            'tic_sic_no'=>$request->tic_sic_no,
            'mersis_no'=>$request->mersis_no
        ]);

        return new RestaurantDocumentResource($restaurant);
    }

    public function list(Request $request){
        $restaurants = Restaurant::all();

        return RestaurantResource::collection($restaurants);
    }
    public function myList(Request $request){
        $user = auth()->user();
        $restaurants = Restaurant::where('user_id',$user->id)->get();

        return RestaurantResource::collection($restaurants);
    }
    public function getById($id){
        $restaurant = Restaurant::find($id);
        return new RestaurantResource($restaurant);
    }

    public function photosStore(Request $request)
    {
        $user = auth()->user();
        if(!$request->id){
            return response()->json(['error'=>'id key göndermelisin !'],401);
        }
        $restaurant = Restaurant::find($request->id);
        if(!$restaurant){
            return response()->json(['error'=>'Restaurant bulunamadı !'],401);
        }
        try {
            $this->validate($request, [
                'photos' => 'required',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            if ($request->file('photos')) {
                $images = $request->file('photos');
                //dd($request->file('photos'));
                $flag = true;
                foreach($images as $image)
                {
                    if($image->isValid()){
                        $photo = new RestaurantPhoto();
                        $photo->restaurant_id = $restaurant->id;
                        $photo->filename = $image->getClientOriginalName();
                        $photo->extension = $image->extension();
                        $photo->_order = 0;
                        $photo->size_kb = $image->getSize()/1024;
                        $path = $image->move(public_path().'/images/r_p/'.strstr($restaurant->user->email, '@', true).'/', $photo->filename);
                        $photo->mime_type = MimeType::get($photo->extension);
                        $photo->path = '/images/pp/'.strstr($user->email, '@', true).'/'.$photo->filename;
                        $photo->save();
                        $flag = false;
                    }else{
                        return response()->json(['error'=>'Resimlerden biri yüklenemedi !'],401);
                    }
                }
                if(!is_array($images)){
                    return response()->json(['error'=>'Photos array olarak algılanmadı !'],401);
                }
                if($flag){
                    return response()->json(['error'=>'Flag true döndü ! Bizi bilgilendirin'],401);
                }
            }else{
                return response()->json(['error'=>'Photos keyi bulunamadı !'],401);
            }
        } catch (ValidationException $e) {
            return response()->json(['error'=>'Bir hata meydana geldi !'],401);
        }
        //TODO  release sonrası: 9 taneden fazla resim yükleyememeli. 9u aşarsa uyarı vermeli ya da eskileri silmeli.
        //TODO  release sonrası: size limit koymalı
        $photos = RestaurantPhoto::where('restaurant_id',$restaurant->id)->get();
        return RestaurantPhotoResource::collection($photos);
    }
}
