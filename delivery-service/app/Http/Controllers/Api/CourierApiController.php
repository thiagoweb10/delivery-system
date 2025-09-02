<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courier\AcceptDeliveryRequest;
use App\Models\Delivery;
use App\Services\CourierService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourierApiController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected CourierService $courierService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function availableDeliveries(Request $request): JsonResponse
    {
        try {
            $data = $this->courierService->listAvailableDeliveries($request->only(['description']));

            return $this->successResponse(
                $data, 'Listagem gerada com sucesso!'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }
    }

    public function getCountByStatus()
    {
        // dd($this->courierService->getCountByStatus());
        try {
            $data = $this->courierService->getCountByStatus();

            return $this->successResponse(
                $data->toArray(), 'Listagem gerada com sucesso!'
            );
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     *  Accepted delivery for courier.
     */
    public function acceptDelivery(AcceptDeliveryRequest $request, Delivery $delivery): JsonResponse
    {
        try {
            $dto = $request->toDTO($delivery);

            $this->courierService->acceptDelivery($delivery, $dto);

            return $this->successResponse([], 'Entrega aceita com sucesso!', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     *  release delivery for courier.
     */
    public function releaseDelivery(Delivery $delivery)
    {
        try {
            $this->courierService->releaseDelivery($delivery);

            return $this->successResponse([], 'Entrega devolvida para a fila com sucesso!', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function completeDelivery(Delivery $delivery)
    {
        try {
            $this->courierService->completeDelivery($delivery);

            return $this->successResponse([], 'Entrega finalizada com sucesso!', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function getDeliveryHistory()
    {
        // $userRoleId = authUserRole();

        try {
            $data = $this->courierService->getHistory();

            return $this->successResponse($data, 'Historico gerado com sucesso!', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
