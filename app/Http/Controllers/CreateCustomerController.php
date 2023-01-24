<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateCustomerController extends Controller
{
    /**
     * Summary of handle
     * @OA\Post(
     *     path="/customers",
     *     tags={"customers"},
     *     operationId="addCustomer",
     *     summary="Add a new customer",
     *     description="",
     *     @OA\RequestBody(
     *         description="Customer object that needs to be added",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CreateCustomer")
     *         )
     *     ),
     *      @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error: Unprocessable Content",
     *     )
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $this->validate($request, [
            "first_name" => "required",
            "last_name" => "required",
            "document" => "required|numeric|digits:11|unique:customers",
            "birth_date" => "required|date"
        ]);

        $params = $request->all();

        $response = new Customer($params);

        $response->save();

        return response()->json($response, 201);
    }
}
