<?php

namespace App\Http\Controllers\Api;
use Validator;

class RequestValidator {

	public static $userRules = [
		'name' => 'required|min:4|max:15',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
	];

	public static function signupValidation($user) {
		return Validator::make($user, self::$userRules);
	}
	

}
