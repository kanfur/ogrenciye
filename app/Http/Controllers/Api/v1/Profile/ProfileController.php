<?php

namespace App\Http\Controllers\Api\v1\Profile;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the specified profile.
     *
     * @return UserResource
     */
    public function show()
    {
        $user = auth()->user();

        return new UserResource($user);//response()->json(["data" => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return UserResource
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name?$request->name:$user->name;
        $user->surname = $request->surname?$request->surname:$user->surname;
        $user->about = $request->about?$request->about:$user->about;
        $user->phone = $request->phone?$request->phone:$user->phone;
        $user->birthday = $request->birthday?$request->birthday:$user->birthday;
        $user->updated_at = Carbon::now();
        $user->save();
        return new UserResource($user);
    }
}
