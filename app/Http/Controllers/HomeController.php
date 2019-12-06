<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function avatar(Request $request) {

        if($request->hasFile('avatar')) {
    
            $user = User::find($request->id);
            $user->avatar =  $request->file('avatar')->getClientOriginalName();
            $user->save();
    
            $request->file('avatar')->storeAs('', $request->file('avatar')->getClientOriginalName(), 'public_uploads');
            return response()->json(env('APP_URL').'images/'.$request->file('avatar')->getClientOriginalName());
        }
    }
    
}
