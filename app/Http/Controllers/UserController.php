<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $item = new UserResource(User::all());
        return response()->json($item);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        return response()->json($request->all());
    }

    public function show($id)
    {
        $item = User::find($id);
        return response()->json($item);
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $item = User::find($id);

        $password = !empty($request->password) ? bcrypt($request->password) : $item->password;
        $request->merge([
            'password' => $password
        ]);

        $item->update($request->all());

        return response()->json($id);
    }

    public function destroy($id)
    {

    }
}
