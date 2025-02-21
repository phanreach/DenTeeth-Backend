<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services; // Adjust if your model is named differently

class ServiceController extends Controller
{
    /**
     * Display a listing of all services.
     */
    public function index()
    {
        $services = Services::all();
        return response()->json($services);
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        // Optionally, validate the incoming request data
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description'  => 'required|string',
            'cost'         => 'required|numeric|min:0',
        ]);

        $service = new Services;
        $service->service_name = $request->service_name;
        $service->description  = $request->description;
        $service->cost         = $request->cost;
        $service->save();

        return response()->json([
            "message" => "Service Added.",
            "data"    => $service,
        ], 201);
    }

    /**
     * Display the specified service.
     */
    public function show($id)
    {
        $service = Services::find($id);

        if ($service) {
            return response()->json($service);
        } else {
            return response()->json([
                "message" => "Service not found",
            ], 404);
        }
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, $id)
    {
        $service = Services::find($id);

        if (!$service) {
            return response()->json([
                "message" => "Service not found",
            ], 404);
        }

        // Optionally, validate the incoming data
        $request->validate([
            'service_name' => 'sometimes|required|string|max:255',
            'description'  => 'sometimes|required|string',
            'cost'         => 'sometimes|required|numeric|min:0',
        ]);

        // Update the fields only if they are present in the request
        $service->service_name = $request->input('service_name', $service->service_name);
        $service->description  = $request->input('description', $service->description);
        $service->cost         = $request->input('cost', $service->cost);
        $service->save();

        return response()->json([
            "message" => "Service updated successfully.",
            "data"    => $service,
        ]);
    }

    /**
     * Remove the specified service.
     */
    public function destroy($id)
    {
        $service = Services::find($id);

        if (!$service) {
            return response()->json([
                "message" => "Service not found",
            ], 404);
        }

        $service->delete();

        return response()->json([
            "message" => "Service deleted successfully.",
        ]);
    }
}
