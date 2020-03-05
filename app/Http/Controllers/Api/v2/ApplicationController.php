<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationsByMenuIdResource;
use App\Model\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function listByMenu($id){
        $applications = Application::where('menu_id',$id)->get();

        return ApplicationsByMenuIdResource::collection($applications);
    }
}
