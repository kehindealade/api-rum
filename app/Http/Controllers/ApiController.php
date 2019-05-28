<?php

namespace Rumi\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;

use Rumi\Models\User;
use Rumi\Models\Leaser;
use Rumi\Models\Roomer;


class ApiController extends Controller
{  
    public function userLogin(Request $request){
		$credentials = $request->only('email', 'password');
		$token = null;
		try {
		    if (!$token = JWTAuth::attempt($credentials)) {
		        return response()->json([
		            'response' => 'error',
		            'message' => 'invalid_email_or_password',
		        ]);
		    }
		} catch (JWTAuthException $e) {
		    return response()->json([
		        'response' => 'error',
		        'message' => 'failed_to_create_token',
		    ]);
		}
		return response()->json([
		    'response' => 'success',
		    'result' => [
		        'token' => $token,
		        'message' => 'I am front user',
		    ],
		]);
    }


    public function leaserLogin(Request $request){
		$credentials = $request->only('email', 'password');
		$token = null;
		try {
		    if (!$token = JWTAuth::attempt($credentials)) {
		        return response()->json([
		            'response' => 'error',
		            'message' => 'invalid_email_or_password',
		        ]);
		    }
		} catch (JWTAuthException $e) {
		    return response()->json([
		        'response' => 'error',
		        'message' => 'failed_to_create_token',
		    ]);
		}
		return response()->json([
		    'response' => 'success',
		    'result' => [
		        'token' => $token,
		        'message' => 'I am leaser user',
		    ],
		]);
	}
	

	public function roomerLogin(Request $request){
		$credentials = $request->only('email', 'password');
		$token = null;
		try {
		    if (!$token = JWTAuth::attempt($credentials)) {
		        return response()->json([
		            'response' => 'error',
		            'message' => 'invalid_email_or_password',
		        ]);
		    }
		} catch (JWTAuthException $e) {
		    return response()->json([
		        'response' => 'error',
		        'message' => 'failed_to_create_token',
		    ]);
		}
		return response()->json([
		    'response' => 'success',
		    'result' => [
		        'token' => $token,
		        'message' => 'I am roomer user',
		    ],
		]);
	}
}

