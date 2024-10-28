<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    //Registeer user
    public function register(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name'=>  $attrs['name'],
            'email'=>  $attrs['email'],
            'password'=>  bcrypt($attrs['password']),
        ]);

        // return user & token in response
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    // Login user

    public function login(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // attempt login
        if(!Auth::attempt($attrs))
        {
            return response([
                'message' => 'Invalid credentials.'

            ], 403);
        }

        // return user & token in response
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    // logout user
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message'=>'Logout success.'
        ], 200);
    }

    //get user details
    public function user()
    {
        return response([
            'user'=> auth()->user()
        ], 200);
    }


     /**
     * Méthode pour attribuer un rôle à un utilisateur.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request)
{
    // Vérifiez si l'utilisateur est authentifié et a le rôle d'administrateur
    if (Auth::check() && Auth::user()->role === 'admin') {
        // Validez les champs de la requête
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string'
        ]);

        // Trouvez l'utilisateur et attribuez le rôle
        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->save();

        return response(['message' => 'Role assigned successfully'], 200);
    }

    return response(['message' => 'Unauthenticated or insufficient permissions'], 403);
}

}