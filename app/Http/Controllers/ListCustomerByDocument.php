<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ListCustomerByDocument extends Controller
{
    /**
     * @OA\Get(
     *     path="/customers/{document}",
     *     tags={"List a customer by document"},
     *     operationId="listACustomerByDocument",
     *     summary="List all customers",
     *     description="List all customers",
     *     @OA\Parameter(
     *         description="Document of customer",
     *         in="path",
     *         name="document",
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
    public function handle(Request $request, string $document): JsonResponse
    {
        $customer = $this->getCustomerBy($document);

        if (is_null($customer)) {
            return response()->json(
                [
                    'document' => ["Customer with document {$document} not found."]
                ],
                404
            );
        }

        return response()->json($customer);
    }

    /**
     * @SuppressWarnings(PHPMD)
     * @return \App\Models\Customer|null.
     */
    private function getCustomerBy(string $document)
    {
        return Customer::all()
            ->firstWhere('document', '=', $document);
    }
}
