<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addresses; 

class AddressController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/addresses",
     *     tags={"Addresses"},
     *     summary="Get all addresses",
     *     description="Returns all addresses",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not found")
     * )
     */
    public function index()
    {
        $addresses = Addresses::all();
        return response()->json($addresses);
    }

    /**
     * @OA\Post(
     *     path="/api/addresses",
     *     tags={"Addresses"},
     *     summary="Create a new address",
     *     description="Create a new address",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"house_number", "street_name", "street_number", "commune", "district", "province", "city", "postal_code"},
     *             @OA\Property(property="house_number", type="integer", example="123"),
     *             @OA\Property(property="street_name", type="string", example="Main Street"),
     *             @OA\Property(property="street_number", type="integer", example="456"),
     *             @OA\Property(property="commune", type="string", example="Commune"),
     *             @OA\Property(property="district", type="string", example="District"),
     *             @OA\Property(property="province", type="string", example="Province"),
     *             @OA\Property(property="city", type="string", example="City"),
     *             @OA\Property(property="postal_code", type="string", example="12345"),
     *         )
     *     ),
     *     @OA\Response(response="201", description="Address added successfully"),
     *     @OA\Response(response="422", description="Invalid data")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'house_number' => 'required|integer',
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|integer',
            'commune' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        $address = Addresses::create($request->all());

        return response()->json([
            "message" => "Address added successfully.",
            "address" => $address
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/addresses/{id}",
     *     tags={"Addresses"},
     *     summary="Get a specific address",
     *     description="Returns a specific address by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Address not found")
     * )
     */
    public function show($id)
    {
        $address = Addresses::find($id);

        if ($address) {
            return response()->json($address);
        } else {
            return response()->json(["message" => "Address not found"], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/addresses/{id}",
     *     tags={"Addresses"},
     *     summary="Update an existing address",
     *     description="Update an existing address",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="house_number", type="integer", example="123"),
     *             @OA\Property(property="street_name", type="string", example="Main Street"),
     *             @OA\Property(property="street_number", type="integer", example="456"),
     *             @OA\Property(property="commune", type="string", example="Commune"),
     *             @OA\Property(property="district", type="string", example="District"),
     *             @OA\Property(property="province", type="string", example="Province"),
     *             @OA\Property(property="city", type="string", example="City"),
     *             @OA\Property(property="postal_code", type="string", example="12345"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Address updated successfully"),
     *     @OA\Response(response="404", description="Address not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $address = Addresses::find($id);

        if ($address) {
            $request->validate([
                'house_number' => 'sometimes|integer',
                'street_name' => 'sometimes|string|max:255',
                'street_number' => 'sometimes|integer',
                'commune' => 'sometimes|string|max:255',
                'district' => 'sometimes|string|max:255',
                'province' => 'sometimes|string|max:255',
                'city' => 'sometimes|string|max:255',
                'postal_code' => 'sometimes|string|max:20',
            ]);

            $address->update($request->all());

            return response()->json([
                "message" => "Address updated successfully.",
                "address" => $address
            ], 200);
        } else {
            return response()->json(["message" => "Address not found."], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/addresses/{id}",
     *     tags={"Addresses"},
     *     summary="Delete an address",
     *     description="Delete an address by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Address deleted successfully"),
     *     @OA\Response(response="404", description="Address not found")
     * )
     */
    public function destroy($id)
    {
        $address = Addresses::find($id);

        if ($address) {
            $address->delete();
            return response()->json(["message" => "Address deleted successfully."], 200);
        } else {
            return response()->json(["message" => "Address not found."], 404);
        }
    }
}
