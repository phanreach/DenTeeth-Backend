<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services; // Adjust if your model is named differently

class ServiceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/services",
     *     tags={"Services"},
     *     summary="Get all services",
     *     description="Returns all available services",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        $services = Services::all();
        return response()->json($services);
    }

    /**
     * @OA\Post(
     *     path="/api/services",
     *     tags={"Services"},
     *     summary="Create a new service",
     *     description="Stores a new service record",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"service_name", "description", "cost"},
     *             @OA\Property(property="service_name", type="string", example="Dental Cleaning"),
     *             @OA\Property(property="description", type="string", example="A thorough cleaning of the teeth"),
     *             @OA\Property(property="cost", type="number", format="float", example=49.99)
     *         )
     *     ),
     *     @OA\Response(response="201", description="Service added successfully"),
     *     @OA\Response(response="422", description="Invalid data")
     * )
     */
    public function store(Request $request)
    {
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
     * @OA\Get(
     *     path="/api/services/{id}",
     *     tags={"Services"},
     *     summary="Get a specific service",
     *     description="Returns a service by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Service not found")
     * )
     */
    public function show($id)
    {
        $service = Services::find($id);

        if ($service) {
            return response()->json($service);
        } else {
            return response()->json(["message" => "Service not found"], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/services/{id}",
     *     tags={"Services"},
     *     summary="Update an existing service",
     *     description="Update an existing service record",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="service_name", type="string", example="Teeth Whitening"),
     *             @OA\Property(property="description", type="string", example="Whitening treatment for brighter teeth"),
     *             @OA\Property(property="cost", type="number", format="float", example=99.99)
     *         )
     *     ),
     *     @OA\Response(response="200", description="Service updated successfully"),
     *     @OA\Response(response="404", description="Service not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $service = Services::find($id);

        if (!$service) {
            return response()->json(["message" => "Service not found"], 404);
        }

        $request->validate([
            'service_name' => 'sometimes|required|string|max:255',
            'description'  => 'sometimes|required|string',
            'cost'         => 'sometimes|required|numeric|min:0',
        ]);

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
     * @OA\Delete(
     *     path="/api/services/{id}",
     *     tags={"Services"},
     *     summary="Delete a service",
     *     description="Deletes a service by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Service deleted successfully"),
     *     @OA\Response(response="404", description="Service not found")
     * )
     */
    public function destroy($id)
    {
        $service = Services::find($id);

        if (!$service) {
            return response()->json(["message" => "Service not found"], 404);
        }

        $service->delete();

        return response()->json(["message" => "Service deleted successfully."]);
    }
}