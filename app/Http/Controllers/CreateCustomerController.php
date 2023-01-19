<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class CreateCustomerController extends Controller
{
    public function handle(): JsonResponse
    {
        return response()->json([]);
    }
}
