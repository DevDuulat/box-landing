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
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:25',
            'message' => 'nullable|string|max:500',
        ]);

        try {
            Lead::create(array_merge($data, [
                'status' => LeadStatus::NEW,
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Заявка принята!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }
}
