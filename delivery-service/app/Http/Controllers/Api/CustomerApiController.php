<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Traits\ApiResponseTrait;

class CustomerApiController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected CustomerService $customerService
    ) {
    }

    /*
     * Display a listing of the resource.
     */
    public function getdeliveries()
    {
        try {
            $data = $this->customerService->listDeliveries();

            return $this->successResponse(
                $data, 'Listagem gerada com sucesso!'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }
    }

    public function deliveryHistory()
    {
    }

    public function trackDelivery($trackingCode)
    {
    }

    public function activeDeliveries()
    {
    }

    public function pendingDeliveries()
    {
    }

    public function confirmReception($deliveryId)
    {
    }

    public function reportIssue($deliveryId, Request $request)
    {
    }

    public function rateDelivery($deliveryId, Request $request)
    {
    }

    public function notifications()
    {
    }

    public function downloadInvoice($deliveryId)
    {
    }

    public function expectedArrival($deliveryId)
    {
    }
}
