<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments; 

class AppointmentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Get all appointments",
     *     description="Returns all appointments",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not found")
     * )
     */
    public function index()
    {
        $appointments = Appointments::all();
        return response()->json($appointments);
    }

    /**
     * @OA\Post(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Create a new appointment",
     *     description="Create a new appointment",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "service_id", "status"},
     *             @OA\Property(property="user_id", type="integer", example="1"),
     *             @OA\Property(property="service_id", type="integer", example="2"),
     *             @OA\Property(property="status", type="string", example="pending"),
     *         )
     *     ),
     *     @OA\Response(response="201", description="Appointment added successfully"),
     *     @OA\Response(response="422", description="Invalid data")
     * )
     */
    public function store(Request $request)
    {
        $appointment = new Appointments;
        $appointment->user_id = $request->user_id;
        $appointment->service_id = $request->service_id;
        $appointment->status = $request->status;
        $appointment->save();

        return response()->json([
            "message" => "Appointment Added."
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Get a specific appointment",
     *     description="Returns a specific appointment by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Appointment not found")
     * )
     */
    public function show($id)
    {
        $appointment = Appointments::find($id);

        if ($appointment) {
            return response()->json($appointment);
        } else {
            return response()->json(["message" => "Appointment not found"], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Update an existing appointment",
     *     description="Update an existing appointment",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example="1"),
     *             @OA\Property(property="service_id", type="integer", example="2"),
     *             @OA\Property(property="status", type="string", example="confirmed"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Appointment updated successfully"),
     *     @OA\Response(response="404", description="Appointment not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointments::find($id);

        if ($appointment) {
            $appointment->user_id = $request->user_id ?? $appointment->user_id;
            $appointment->service_id = $request->service_id ?? $appointment->service_id;
            $appointment->status = $request->status ?? $appointment->status;
            $appointment->save();

            return response()->json([
                "message" => "Appointment updated successfully.",
                "appointment" => $appointment
            ], 200);
        } else {
            return response()->json(["message" => "Appointment not found."], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Delete an appointment",
     *     description="Delete an appointment by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Appointment deleted successfully"),
     *     @OA\Response(response="404", description="Appointment not found")
     * )
     */
    public function destroy($id)
    {
        $appointment = Appointments::find($id);

        if ($appointment) {
            $appointment->delete();
            return response()->json(["message" => "Appointment deleted successfully."], 200);
        } else {
            return response()->json(["message" => "Appointment not found."], 404);
        }
    }
}
