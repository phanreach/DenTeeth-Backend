<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis; // Import the model

class DiagnosisController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/diagnoses",
     *     tags={"Diagnoses"},
     *     summary="Get all diagnoses",
     *     description="Returns all diagnoses",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not found")
     * )
     */
    public function index()
    {
        $diagnoses = Diagnosis::all();
        return response()->json($diagnoses);
    }

    /**
     * @OA\Post(
     *     path="/api/diagnoses",
     *     tags={"Diagnoses"},
     *     summary="Create a new diagnosis",
     *     description="Create a new diagnosis",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "symptom_data_id", "photo"},
     *             @OA\Property(property="user_id", type="integer", example="1"),
     *             @OA\Property(property="symptom_data_id", type="integer", example="2"),
     *             @OA\Property(property="photo", type="string", example="photo_url.jpg"),
     *         )
     *     ),
     *     @OA\Response(response="201", description="Diagnosis added successfully"),
     *     @OA\Response(response="422", description="Invalid data")
     * )
     */
    public function store(Request $request)
    {
        $diagnosis = new Diagnosis;
        $diagnosis->user_id = $request->user_id;
        $diagnosis->symptom_data_id = $request->symptom_data_id;
        $diagnosis->photo = $request->photo;
        $diagnosis->save();

        return response()->json([
            "message" => "Diagnosis Added.",
            "diagnosis" => $diagnosis
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/diagnoses/{id}",
     *     tags={"Diagnoses"},
     *     summary="Get a specific diagnosis",
     *     description="Returns a specific diagnosis by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Diagnosis not found")
     * )
     */
    public function show($id)
    {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            return response()->json($diagnosis);
        } else {
            return response()->json(["message" => "Diagnosis not found."], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/diagnoses/{id}",
     *     tags={"Diagnoses"},
     *     summary="Update an existing diagnosis",
     *     description="Update an existing diagnosis",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example="1"),
     *             @OA\Property(property="symptom_data_id", type="integer", example="2"),
     *             @OA\Property(property="photo", type="string", example="updated_photo.jpg"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Diagnosis updated successfully"),
     *     @OA\Response(response="404", description="Diagnosis not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            $diagnosis->user_id = $request->user_id ?? $diagnosis->user_id;
            $diagnosis->symptom_data_id = $request->symptom_data_id ?? $diagnosis->symptom_data_id;
            $diagnosis->photo = $request->photo ?? $diagnosis->photo;
            $diagnosis->save();

            return response()->json([
                "message" => "Diagnosis updated successfully.",
                "diagnosis" => $diagnosis
            ], 200);
        } else {
            return response()->json(["message" => "Diagnosis not found."], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/diagnoses/{id}",
     *     tags={"Diagnoses"},
     *     summary="Delete a diagnosis",
     *     description="Delete a diagnosis by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Diagnosis deleted successfully"),
     *     @OA\Response(response="404", description="Diagnosis not found")
     * )
     */
    public function destroy($id)
    {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            $diagnosis->delete();
            return response()->json(["message" => "Diagnosis deleted successfully."], 200);
        } else {
            return response()->json(["message" => "Diagnosis not found."], 404);
        }
    }
}