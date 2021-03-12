<?php

namespace App\Http\Controllers;

use App\Models\Person;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller {

    /**
     * Retrieves a paginated list of users.
     * 
     * @param Request $request
     * @return JsonResource
     */
    public function index(Request $request) {
        return JsonResource::collection(
            Person::simplePaginate($request->input('paginate') ?? 15)
        );
    }

    /**
     * Stores a new user.
     * 
     * @param  Request  $request
     * @return JsonResource
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            "company_id" => "required|numeric",
            "person_type" => "required|numeric",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:people,email",
            "personal_id" => "required|string",
            "social_secutiry_number" => "required|string"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        DB::beginTransaction();
        try {
            $incommingData = $validator->validate();

            $person = new Person();
            $person->company_id = $incommingData['company_id'];
            $person->person_type = $incommingData['person_type'];
            $person->first_name = $incommingData['first_name'];
            $person->last_name = $incommingData['last_name'];
            $person->email = $incommingData['email'];
            $person->personal_id = $incommingData['personal_id'];
            $person->social_secutiry_number = $incommingData['social_secutiry_number'];
            $person->save();

            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }

        return (new JsonResource($person));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person) {
        return (new JsonResource($person));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
