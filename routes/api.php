<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('test', function (){
    return 'Ok';
});

Route::namespace('Api\v1')->prefix('v1')->group(function () {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    /**
     * University
     */
    Route::get('university/list','UniversityController@list');

    Route::group(['middleware' => ['jwt.verify']], function() {
        /** Register 2. page **/
        Route::post('register/education', 'AuthController@registerEducation');
        /**
         * Auth
         */
        Route::get('me', 'AuthController@me');
        Route::get('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
        /**
         * Profile /
         */
        Route::get('profile', 'Profile\ProfileController@show');
        Route::post('profile', 'Profile\ProfileController@update');
        Route::post('profile/photo','Profile\PhotoController@store');
        Route::delete('profile/photo','Profile\PhotoController@delete');
        //Route::get('profile/education','Profile\CareerController@show');
        //Route::post('profile/education','Profile\CareerController@update');
        /**
         * Restaurants
         */
        Route::post('restaurant/create','RestaurantController@create');
        Route::post('restaurant/create/document','RestaurantController@createDocuments');
        Route::get('restaurant/details/{id}','RestaurantController@getById'); // restaurant detaylar
        Route::get('restaurant/list','RestaurantController@list'); //tüm restorantlar
        Route::get('restaurant/my-list','RestaurantController@myList'); // bana ait restaurantlar
        Route::post('restaurant/photos','RestaurantController@photosStore'); //restaurant resimleri kaydet

        /**
         * Menu & Applications
         */
        Route::post('menu','MenuController@create'); // restaurant için menu oluştur / başvuru limiti belirle
        Route::get('menu/list','MenuController@listByFilter'); // tüm menüleri filtrele
        Route::get('menu/list/{id}','MenuController@listByRestaurantId'); // tüm menüleri filtrele
        Route::delete('menu/remove','MenuController@remove');
        /**** Applications ****/
        Route::post('menu/apply','ApplicationController@apply'); //başvur
            Route::get('menu/{id}/applications','ApplicationController@listByMenu'); //menuye başvuruları göster
        Route::get('menu/applications','ApplicationController@myApplications'); //menulere başvurularımı göster
        Route::delete('menu/application/remove','ApplicationController@remove'); //id ile başvuruyu kaldır

        /**
         * Universites
         */

        /**
         * User Locations
         */
        //TODO locations
    });
});
Route::namespace('Api\v2')->prefix('v2')->group(function () {
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('menu/{id}/applications','ApplicationController@listByMenu'); //menuye başvuruları göster
    });
});