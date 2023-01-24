<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DeleteACustomerController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/customers/{uuid}",
     *     tags={"Delete a customer"},
     *     operationId="deleteACustomer",
     *     summary="Delete a customers",
     *     description="Delete a customers",
     *     @OA\Parameter(
     *         description="Uuid of customer",
     *         in="path",
     *         name="uuid",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
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
        $customer = $this->getCustomerBy($uuid);

        if (is_null($customer)) {
            return response()->json(
                [
                    'document' => ["Customer with uuid {$uuid} not found."]
                ],
                404
            );
        }

        $customer->delete();

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
