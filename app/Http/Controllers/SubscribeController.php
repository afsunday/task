<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    /**
     * create post
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => ['required', 'integer', 'exists:sites,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],        
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'validation error', 'error'=> $validator->errors()], 400);
        }

        try {
            $subscribe = Subscriber::create($validator->validated());
            return response()->json($subscribe, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
