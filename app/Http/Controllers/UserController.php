<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller {
    
    /**
     * Retrieves a paginated list of users.
     * 
     * @param Request $request
     * @return JsonResource
     */
    public function index(Request $request) {
        return JsonResource::collection(
            User::simplePaginate($request->input('paginate') ?? 15)
        );
    }


    /**
     * Stores a new user.
     * 
     * @param  Request  $request
     * @return JsonResource
     */
    public function store(Request $request) {
        return JsonResource::collection($request->all());
    }


}
