<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis; // Import the model

class DiagnosisController extends Controller
{
    public function index()
    {
        $diagnoses = Diagnosis::all();
        return response()->json($diagnoses); // Fixed variable
    }

    public function store(Request $request)
    {
        $diagnosis = new Diagnosis;
        $diagnosis->user_id = $request->user_id;
        $diagnosis->symptom_data_id = $request->symptom_data_id; // Fixed column name
        $diagnosis->photo = $request->photo; // Fixed field assignment
        $diagnosis->save();

        return response()->json([
            "message" => "Diagnosis Added.",
            "diagnosis" => $diagnosis
        ], 201);
    }

    public function show($id)
    {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            return response()->json($diagnosis);
        } else {
            return response()->json([
                "message" => "Diagnosis not found."
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            $diagnosis->user_id = $request->user_id ?? $diagnosis->user_id;
            $diagnosis->symptom_data_id = $request->symptom_data_id ?? $diagnosis->symptom_data_id; // Fixed column name
            $diagnosis->photo = $request->photo ?? $diagnosis->photo; // Fixed field assignment
            $diagnosis->save();

            return response()->json([
                "message" => "Diagnosis updated successfully.",
                "diagnosis" => $diagnosis
            ], 200);
        } else {
            return response()->json([
                "message" => "Diagnosis not found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            $diagnosis->delete();

            return response()->json([
                "message" => "Diagnosis deleted successfully."
            ], 200);
        } else {
            return response()->json([
                "message" => "Diagnosis not found."
            ], 404);
        }
    }
}
