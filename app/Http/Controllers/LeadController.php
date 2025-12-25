<?php

namespace App\Http\Controllers;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:25',
            'message' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Lead::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'message' => $request->message,
                'status' => LeadStatus::NEW,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Заявка успешно отправлена!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка сервера. Попробуйте позже.'
            ], 500);
        }
    }
}
