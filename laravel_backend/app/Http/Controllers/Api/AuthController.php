<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Session;
use Mail;
use illuminate\Auth\Events\Verified;



class AuthController extends Controller
{
    public function verify(Request $request) {
        $user = User::findOrFail($request->id);

        if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                "message" => "Verif dulu",
                "success" => false
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                "message" => "Udah verif",
                "success" => false
            ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            "message" => "Email Berhasil di Verif",
            "success" => true
        ]);
    }
    public function register(Request $request)
    {
        $registrationData = $request->all();

        $validate = Validator::make($registrationData, [
            'name' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required',
        ]);

        if($validate->fails())
            // return response(['message' => $validate->errors()], 400);
            return response()->json(['message' => $validate->errors()], 400);
        
        $registrationData['password'] = bcrypt($request->password);

        
        $user = User::create($registrationData);
        $user->sendEmailVerificationNotification();
        event(new AuthController($user));
        // return response([
        //     'message' => 'registration Success',
        //     'user' => $user
        // ], 200);

        return response()->json([
            'message' => 'registration Success',
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);
        

        if($validate->fails())
            // return response(['message' => $validate->errors()], 400);
            return response()->json(['message' => $validate->errors()], 400);

        if(!Auth::attempt($loginData))
            // return response(['message' => 'Invalid Credentials'], 401);
            return response()->json(['message' => 'Invalid Credentials'], 401);

        $user = Auth::user();
        if (!$user->hasVerifiedEmail()) {
            return response(['message'=>'Silakan verif dulu di email hehehe :)']);
        }
        $token = $user->createToken('Authentication Token')->accessToken;

        // return response([
        //     'message' => 'Authenticated',
        //     'user' => $user,
        //     'token_type' => 'Bearer',
        //     'access_token' => $token
        // ]);

        return response()->json([
            'success' => true, 
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $removeToken = $request->user()->tokens()->delete();

        if($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'Logout Success!',  
            ]);
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if(!is_null($user)){
            return response()->json([
                'message' => 'Retrieve User Success',
                'data' => $user
            ], 200);
        }

        return response()->json([
            'message' => 'User Not Found'
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $updateData['password'] = bcrypt($request->password);
        if($validate->fails())
            return response()->json(['message' => $validate->errors()], 400);

        $user->name = $updateData['name'];
        $user->email = $updateData['email'];
        $user->password = $updateData['password'];
        
        if($user->save()){
            return response()->json([
                'message' => 'Update User Success',
                'data' => $user
            ], 200);
        }
    }

   
}