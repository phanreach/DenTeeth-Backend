<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addresses; 

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Addresses::all();
        return response()->json($addresses);
    }

    public function store(Request $request)
    {
        // Validation
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

        // Create a new address
        $address = Addresses::create($request->all());

        return response()->json([
            "message" => "Address added successfully.",
            "address" => $address
        ], 201);
    }

    public function show($id)
    {
        $address = Addresses::find($id);

        if ($address) {
            return response()->json($address);
        } else {
            return response()->json(["message" => "Address not found"], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $address = Addresses::find($id);

        if ($address) {
            // Validation
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

            // Update only provided fields
            $address->update($request->all());

            return response()->json([
                "message" => "Address updated successfully.",
                "address" => $address
            ], 200);
        } else {
            return response()->json(["message" => "Address not found."], 404);
        }
    }

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
