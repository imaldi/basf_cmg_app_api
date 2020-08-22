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

    public function register(Request $request)
    {     
        dd("ada");

        try{
            $employee = new MasterEmployee();
            $employee->employee_name = $request->employee_name; 
            $employee->email = $request->email; 
            $employee->phone_number = $request->phone_number; 
            $employee->username = $request->username;
            $employee->nik = $request->nik;
            $employee->password = $request->password;
            $employee->saveOrFail();

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => 'Berhasil mendaftar',
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'Gagal mendaftar',
            ];    
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function login(Request $request)
    {     
        try{
            $statusCode = 200;
            $query=MasterEmployee::where('email','=',$request->email)->first();

            if(Hash::check($request->input_password, $query->password)){

                $response = [
                    'error' => true,
                    'message' => 'Login Berhasil',
                    'data' => [$query]
                ];    
            } else {
                $response = [
                    'error' => false,
                    'message' => 'Login Gagal11',
                ];    
            }
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Login Gagal';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }



}