<?php

use App\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('v1/user', 'UserController');
Route::post('avatar', function (Request $request) {

    if($request->hasFile('avatar')) {

        $user = User::find($request->id);
        $user->avatar =  $request->file('avatar')->getClientOriginalName();
        $user->save();

        $request->file('avatar')->storeAs('', $request->file('avatar')->getClientOriginalName(), 'public_uploads');
        return response()->json(env('APP_URL').'images/'.$request->file('avatar')->getClientOriginalName());
    }

    
})->name('avatar.store');
