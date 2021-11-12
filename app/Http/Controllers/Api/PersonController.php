<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Person\StorePersonRequest;
use App\Http\Requests\Person\UpdatePersonRequest;
use App\Models\Person;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersonRequest $request
     * @return Response
     */
    public function store(StorePersonRequest $request)
    {
        //
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
