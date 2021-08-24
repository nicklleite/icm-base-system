<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Services\UserService;

use Illuminate\Http\Request;

class AuthController extends Controller {
    
    public function register(UserRegisterRequest $request) {

        $request->validate();



    }

}
