<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterEmployee;
// use Illuminate\Support\Facades\Auth;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Validator;
use App\User;



class AuthController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    // public function __construct()
    // {
    //     $this->middleware('auth',['except' => ['login',]]);
    // }

// protected function guard()
// {
//     return Auth::guard('api');
// }

//hanya untuk tes-tes
public function register(Request $request)
{
    //validate incoming request 
    $this->validate($request, [
        'emp_name' => 'required|string',
        'emp_email' => 'required|email|unique:m_employees',
        'emp_username' => 'required|string|unique:m_employees',
        'emp_password' => 'required|confirmed',
    ]);

    try {

        // $user = new User;
        $user = new User;
        $plainPassword = $request->input('password');
        $password = app('hash')->make($plainPassword);
        $user = User::create([
            'emp_name' => $request->input('name'),
            'emp_username' => $request->input('user_name'),
            'emp_email' => $request->input('email'),
            'emp_password' => $password
        ]);
        // $user->name = $request->input('name');
        // $user->emp_username = $request->input('user_name');
        // $user->email = $request->input('email');
        // $plainPassword = $request->input('password');
        // $user->password = app('hash')->make($plainPassword);

        // $user->save();

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
            // 'email' => 'required|string',
            'emp_username' => 'required|string',
            'password' => 'required|string',
        ]);

        // $credentials = $request->only(['email', 'password']);
        $credentials = $request->only(['emp_username', 'password']);

    //     $email    = $request->input('emp_email');
    // $password = $request->input('emp_password');

            // dd($credentials);

        if (! $token = JWTAuth::attempt($credentials)) {
        // if (! $token = Auth::attempt(['emp_email'=>$email, 'emp_password' =>$password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

//     protected function validateLogin(Request $request)
// {
//     $request->validate([
//         $this->username() => 'required|string',
//         'emp_password' => 'required|string',
//     ]);
// }

    public function username()
    {
        return 'emp_username';
    }

   

//     protected function credentials(Request $request)
//     {
//         return $request->only($this->username(), 'emp_password');
//     }
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

    public function failMiddleware($middlewareName){
        return response(['code' => 401, 'message' => $middlewareName.' not allowed'],401);
    }

    ///masih belum d urus dan belum perlu
    // public function updatePassword(Request $request)
    // {     
    //     try{
    //         $data=MasterEmployee::where('emp_email','=',$request->email)->first();
    //         $data->emp_password= Hash::make($request->new_password);
    //         $data->saveOrFail();

    //         $statusCode = 200;
    //         $response = [
    //             'error' => false,
    //             'message' => 'update password Berhasil',
    //         ];    
    //     } catch (Exception $ex) {
    //         $statusCode = 404;
    //         $response = [
    //             'error' => true,
    //             'message' => 'update password Gagal',
    //         ];
    //     } 
    //     finally {
    //         return response($response,$statusCode)->header('Content-Type','application/json');
    //     }
    // }


}