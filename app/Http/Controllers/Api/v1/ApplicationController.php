<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Model\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Request $request)
    {
        $user = $request->user();

        if(!$request->menu_id){
            return response()->json(["error" => "menu_id parametresi zorunludur !"]);
        }
        $application = Application::updateOrCreate([
            'menu_id' => $request->menu_id,
            'user_id'=> $user->id,
        ],[
            'menu_id' => $request->menu_id,
            'user_id'=> $user->id,
            'description'=> $request->description,
        ]);

        return new ApplicationResource($application);
    }
    public function listByMenu($id){
        $applications = Application::where('menu_id',$id)->get();

        return ApplicationResource::collection($applications);
    }
    public function myApplications(){
        $user = auth()->user();
        $applications = Application::where('user_id',$user->id)->get();

        return ApplicationResource::collection($applications);
    }
    public function removeMyApplication(Request $request){
        $user = auth()->user();
        //TODO güvenlik yapılmalı. Herkes silemesin.
        if(!$request->menu_id){
            return response()->json(["error" => "menu_id parametresi gereklidir !"]);
        }
        $res = Application::where('menu_id',$request->menu_id)->where('user_id',$user->id)->delete();
        if($res){
            //TODO dil translate yapılacak
            return response()->json(['success' => true,'message'=>'Başvurunuz silindi']);
        }else{
            return response()->json(['error' => 'Başvuru bulunamadı !']);
        }
    }
}
