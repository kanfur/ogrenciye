<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\UniversityResource;
use App\Model\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UniversityController extends Controller
{
    public function list(){
        $arr = array();

        return response()->json(['data' => University::besiktas]);
    }
}
