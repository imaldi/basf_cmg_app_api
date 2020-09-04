<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;


class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function login(Request $request)
    {     
        try{
            $loginEmployee=MasterEmployee::where('email','=',$request->email)->first();
            if(Hash::check($request->input_password, $loginEmployee->password)){
                $statusCode = 200;
                $response = [
                    'error' => true,
                    'message' => 'Login Berhasil',
                    'dataEmployee' => [$loginEmployee]
                ];    
            } else {
                $response = [
                    'error' => false,
                    'message' => 'Password False',
                ];    
            }
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Login Gagal';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function updatePassword(Request $request)
    {     
        try{
            $data=MasterEmployee::where('email','=',$request->email)->first();
            $data->password= Hash::make($request->new_password);
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