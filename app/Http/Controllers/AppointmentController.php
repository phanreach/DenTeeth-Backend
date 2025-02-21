<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments; 

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointments::all();
        return response()->json($appointments);
    }

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

    public function show($id)
    {
        $appointment = Appointments::find($id);

        if ($appointment) {
            return response()->json($appointment);
        } else {
            return response()->json([
                "message" => "Appointment not found"
            ], 404);
        }
    }

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
            return response()->json([
                "message" => "Appointment not found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        $appointment = Appointments::find($id);

        if ($appointment) {
            $appointment->delete();

            return response()->json([
                "message" => "Appointment deleted successfully."
            ], 200);
        } else {
            return response()->json([
                "message" => "Appointment not found."
            ], 404);
        }
    

    }
}
