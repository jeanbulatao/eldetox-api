<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

// OPEN ROUTE
Route::group(['namespace' => 'API'], function () {
    Route::get('/', function () {
        return res('API Server V1 is UP');
    });


    Route::get('/unauthenticated', function () {
        return res(__('auth.unauthenticated'), null, 401);
    })->name('unauthenticated');

    // OPEN
    Route::group([], function () {

    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/check-authentication', function () {
            if (auth() && auth()->user()) {
                $u = auth()->user();
                //$social = SocialMedia::where('id',$u->id)->where('status',1)->first();
                $user = [
                    'user_id'       => $u->id,
                    'hashid'        => encode($u->id, 'uuid'),
                    //'social_id'     => $social ? $social->social_id : null,
                    'email'         => $u->email,
                    'mobile_prefix' => $u->mobile_prefix,
                    'mobile'        => $u->mobile,
                    'name'          => $u->name,
                    'type_info'     => $u->type_info,
                    'gender'        => $u->gender,
                    'bdate'         => $u->bdate,
                ];
                // NOTE: Also update on LoginRepository
                return res('Authenticated', compact('user'));
            }
        });

        Route::group(['prefix' => 'user', 'namespace' => 'User'], function(){
            Route::post('/add', 'UserController@add');
        });
    });
});