<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller {
	
	public function signup(Request $request) {
		$validate = RequestValidator::signupValidation($request->all());
        if($validate->fails()){
        	return response()->json([
        		'status' => 400,
        		'errors' => $validate->errors()
        	]);
        }

		$user = User::create($request->only('name', 'email', 'password'));
		// send confirmation email
		return response()->json(['user' => $user]);
	}
}