<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            "hash" => Str::uuid()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $service = resolve(UserService::class);
        $payload = $request->only(['email', 'username', 'password', 'full_name']);

        $user = $service->store($payload);
        return (new UserResource($user))->response()->setStatusCode(HttpStatusCode::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $user
     * @return JsonResponse
     */
    public function edit($user): JsonResponse
    {
        $service = resolve(UserService::class);
        $user = $service->get($user);

        return (new UserResource($user))->response()->setStatusCode(HttpStatusCode::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  int $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $user): JsonResponse
    {
        $service = resolve(UserService::class);
        $payload = $request->all();

        $user = $service->update($user, $payload);
        return (new UserResource($user))->response()->setStatusCode(HttpStatusCode::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
//    public function destroy(User $user)
//    {
//        //
//    }
}
