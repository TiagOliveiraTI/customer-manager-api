<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class UpdateCustomerController extends Controller
{
    /**
     * @OA\Put(
     *     path="/customers/{uuid}",
     *     tags={"Update a customer"},
     *     operationId="updateACustomer",
     *     summary="Update a customers",
     *     description="Update a customers",
     *     @OA\Parameter(
     *         description="Uuid of customer",
     *         in="path",
     *         name="uuid",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         description="Customer object that needs to be altered",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CreateCustomer")
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Document: Customer with document number not found.",
     *     )
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request, string $uuid): JsonResponse
    {
        $this->validate($request, [
            "first_name" => "required",
            "last_name" => "required",
            "document" => "required|numeric|digits:11",
            "birth_date" => "required|date"
        ]);

        $customer = $this->getCustomerBy($uuid);

        if (is_null($customer)) {
            return response()->json(
                [
                    'document' => ["Customer with uuid {$uuid} not found."]
                ],
                404
            );
        }

        if ($request->document === $customer->document) {
            $newData = [];
            $newData['first_name'] = $request->first_name;
            $newData['last_name'] = $request->last_name;
            $newData['birth_date'] = $request->birth_date;
            $newData['phone_number'] = $request->phone_number;

            $customer->update($newData);

            return response()->json($customer);
        }

        $customer->update($request->all());

        return response()->json($customer);
    }

    /**
     * @SuppressWarnings(PHPMD)
     * @return \App\Models\Customer|null.
     */
    private function getCustomerBy(string $uuid)
    {
        return Customer::all()
            ->firstWhere('uuid', '=', $uuid);
    }
}
