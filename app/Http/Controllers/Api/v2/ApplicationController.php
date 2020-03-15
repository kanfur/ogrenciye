<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationsByMenuIdResource;
use App\Model\Application;
use App\Model\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function listByMenu($id){
        $menu = Menu::find($id);
        $applications = Application::where('menu_id',$id)->get();

        return ApplicationsByMenuIdResource::collection($applications)
            ->additional( [ 'menu' => ['apply_limit'=>$menu->apply_limit, 'apply_count'=>$menu->applications->count()]]);
    }
}
