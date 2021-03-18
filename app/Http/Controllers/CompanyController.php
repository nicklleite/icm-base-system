<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller {
    /**
     * Retrieves a paginated list of users.
     * 
     * @param Request $request
     * @return JsonResource
     */
    public function index(Request $request) {

        $companies = JsonResource::collection(
            Company::simplePaginate($request->input('paginate') ?? 15)
        );

        return $companies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "company_name" => "required|string",
            "trading_name" => "required|string",
            "employer_identification_number" => "required|string|unique:companies,employer_identification_number"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        DB::beginTransaction();
        try {
            $incommingData = $validator->validate();

            $company = new Company();
            $company->access_token = md5(implode(";", $incommingData) . time());
            $company->company_name = $incommingData['company_name'];
            $company->trading_name = $incommingData['trading_name'];
            $company->employer_identification_number = $incommingData['employer_identification_number'];
            $company->save();

            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }

        return (new JsonResource($company));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company) {
        return (new JsonResource($company));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company) {

        $company_before_update = Company::find($company);
        echo __FILE__ . ":" . __LINE__ . "<pre>";print_r($company_before_update);echo "</pre>";die;

        $validator = Validator::make($request->all(), [
            "company_name" => "sometimes|required|string",
            "trading_name" => "sometimes|required|string",
            "employer_identification_number" => "sometimes|required|string|unique:companies,employer_identification_number",
            "status" => "numeric"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        DB::beginTransaction();
        try {
            $incommingData = $validator->validate();

            $company = new Company();
            $company->access_token = md5(implode(";", $incommingData) . time());
            $company->company_name = $incommingData['company_name'];
            $company->trading_name = $incommingData['trading_name'];
            $company->employer_identification_number = $incommingData['employer_identification_number'];
            $company->save();

            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }

        return (new JsonResource($company));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company) {
    }
}
