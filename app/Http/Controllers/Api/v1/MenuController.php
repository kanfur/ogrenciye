<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\MenuResource;
use App\Model\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function create(Request $request){
        $user = $request->user();
        //TODO güvenlik için user kontrolü yapılmalı
        if(!$request->restaurant_id){
             return response()->json(["error" => "restaurant_id parametresi gereklidir !"]);
        }
        $menu = Menu::updateOrCreate([
            'restaurant_id' => $request->restaurant_id,
            'menu_date'=> $request->menu_date,
        ],[
            'restaurant_id' => $request->restaurant_id,
            'description'=> $request->description,
            'menu_date'=> $request->menu_date,
        ]);
        if($request->apply_limit){
            $menu->apply_limit = $request->apply_limit;
            $menu->save();
        }
        return new MenuResource($menu);
    }

    public function listByFilter(Request $request){
        //TODO sayfalama yapılacak
        $menus = Menu::orderBy('menu_date', 'ASC')->get();

        return MenuResource::collection($menus);
    }

    public function listByRestaurantId($id){
        //TODO sayfalama yapılacak
        $menus = Menu::where('restaurant_id',$id)->orderBy('menu_date', 'ASC')->get();

        return MenuResource::collection($menus);
    }

    public function remove(Request $request)
    {
        //TODO güvenlik yapılmalı. Herkes silemesin.
        if(!$request->id){
            return response()->json(["error" => "id parametresi gereklidir !"]);
        }
        $res = Menu::where('id',$request->id)->delete();
        if($res){
            //TODO dil translate yapılacak
            return response()->json(['success' => true,'message'=>'Menü silindi']);
        }else{
            return response()->json(['error' => 'An error has been occured !']);
        }
    }
}
