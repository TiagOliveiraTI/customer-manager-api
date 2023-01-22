<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CreateCustomerController extends Controller
{
    public function handle(Request $request): void
    {
        $this->validate($request, [
            "first_name" => "required",
            "last_name" => "required",
            "document" => "required|numeric",
        ]);
    }
}
