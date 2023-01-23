<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ListAllCustomersController extends Controller
{
    /**
     * @OA\Get(
     *     path="/customers",
     *     tags={"customers"},
     *     operationId="listAllCustomer",
     *     summary="List all customers",
     *     description="List all customers",
     *      @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error: Unprocessable Content",
     *     )
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $response = $this->customer();

        return response()->json($response);
    }

    /**
     * @SuppressWarnings(PHPMD)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function customer()
    {
        return Customer::all();
    }
}
