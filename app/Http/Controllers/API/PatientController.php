<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Display a listing of the resource.
    public function index(): JsonResponse
    {
        $patients = Patient::all();

        return $this->sendResponse(PatientResource::collection($patients), 'Patients retrieved successfully.',200);
    }

    // Store a newly created resource in storage.
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'gender' => 'required',
            'arn_number' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $patient = Patient::create($input);

        return $this->sendResponse(new PatientResource($patient), 'Patient created successfully.',200);
    }

    // Update the specified resource in storage.
    public function update(Request $request, Blog $blog): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $blog->title = $input['title'];
        $blog->detail = $input['detail'];
        $blog->save();

        return $this->sendResponse(new BlogResource($blog), 'Blog updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Patient $blog): JsonResponse
    {
        $blog->delete();

        return $this->sendResponse([], 'Patient deleted successfully.');
    }

}
