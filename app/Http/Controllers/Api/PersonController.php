<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Person\StorePersonRequest;
use App\Http\Requests\Person\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $service = resolve(PersonService::class);
        $persons = $service->list(isPaginated: true);

        return response()->json($persons, HttpStatusCode::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersonRequest $request
     * @return JsonResponse
     */
    public function store(StorePersonRequest $request): JsonResponse
    {
        $service = resolve(PersonService::class);
        $person = $service->store($request->all());

        return (new PersonResource($person))->response()->setStatusCode(HttpStatusCode::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Person $person
     * @return Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePersonRequest $request
     * @param Person $person
     * @return Response
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Person $person
     * @return Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
