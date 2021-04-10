<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\User;



class AuthController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }


// protected function guard()
// {
//     return Auth::guard('api');
// }

public function register(Request $request)
{
    //validate incoming request 
    $this->validate($request, [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
    ]);

    try {

        // $user = new User;
        $user = new MasterEmployee;
        $user->emp_name = $request->input('name');
        $user->emp_username = $request->input('user_name');
        $user->emp_email = $request->input('email');
        $plainPassword = $request->input('password');
        $user->emp_password = app('hash')->make($plainPassword);

        $user->save();

        //return successful response
        return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

    } catch (Exception $e) {
        //return error message
        return response()->json(['message' => 'User Registration Failed!'], 409);
    }

}


    public function login(Request $request)
    {
        $this->validate($request, [
            'emp_email' => 'required|string',
            'emp_password' => 'required|string',
        ]);

        // $credentials = $request->only(['emp_email', 'emp_password']);

        $email    = $request->input('emp_email');
    $password = $request->input('emp_password');

        // if (! $token = Auth::attempt($credentials)) {
        if (! $token = Auth::attempt(['emp_email'=>$email, 'emp_password' =>$password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    // {     
    //     $statusCode=401;
    //     $response=[];
    //     try{
    //         $loginEmployee=MasterEmployee::where('emp_username','=',$request->username)->first();
    //         if(Hash::check($request->input_password, $loginEmployee->emp_password)){
    //             $statusCode = 200;
                
    //             $response = [
    //                 'error' => true,
    //                 'message' => 'Login Berhasil',
    //                 'dataEmployee' => [$loginEmployee]
    //             ];    
    //         } else {
    //             $response = [
    //                 'error' => false,
    //                 'message' => 'Password False',
    //             ];    
    //         }
    //     } catch (Exception $ex) {
    //         $statusCode = 401;
    //         $response['message'] = 'Login Gagal';
    //     } finally {
    //         return response($response,$statusCode)->header('Content-Type','application/json');
    //     }
    // }

    public function updatePassword(Request $request)
    {     
        try{
            $data=MasterEmployee::where('emp_email','=',$request->email)->first();
            $data->emp_password= Hash::make($request->new_password);
            $data->saveOrFail();

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => 'update password Berhasil',
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'update password Gagal',
            ];
        } 
        finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }


}