<?php

namespace App\Services;

use App\DTOs\AcceptDeliveryDTO;
use App\Exceptions\UnauthorizedActionException;
use App\Models\Delivery;
use Illuminate\Pagination\LengthAwarePaginator;

class CourierService
{
    public function listAvailableDeliveries(): LengthAwarePaginator
    {
        return Delivery::CourierIsNull()->DeliveredAtIsNull()->paginate(10);
    }

    public function getCountByStatus()
    {
        return Delivery::query()
            ->CourierBy()
            ->join('delivery_statuses', 'deliveries.delivery_status_id', '=', 'delivery_statuses.id')
            ->select(
                'delivery_statuses.name as status',
                'delivery_statuses.color as color',
                \DB::raw('count(*) as total')
            )
            ->groupBy('delivery_statuses.name', 'delivery_statuses.color')
            ->get();
    }

    public function acceptDelivery(Delivery $delivery, AcceptDeliveryDTO $dto): void
    {
        if ($delivery->courier_id !== null) {
            throw new UnauthorizedActionException('Entrega já foi atribuída!');
        }

        $delivery->update([
            'courier_id' => $dto->courierId,
            'pickup_time' => now()->toDateTimeString(),
            'delivery_status_id' => 2,
        ]);
    }

    public function releaseDelivery(Delivery $delivery): void
    {
        if (is_null($delivery->courier_id)) {
            throw new UnauthorizedActionException('Essa entrega já esta sem entregador.');
        }

        if ($delivery->courier_id != authUserId()) {
            throw new UnauthorizedActionException('Somente o entregador que aceitou esta entrega pode devolvê-la para a fila.');
        }

        $delivery->update([
            'delivery_status_id' => 1,
            'delivered_at' => null,
            'courier_id' => null,
            'pickup_time' => null,
        ]);
    }

    public function completeDelivery(Delivery $delivery): void
    {
        if ($delivery->courier_id != authUserId()) {
            throw new UnauthorizedActionException('Somente o entregador que aceitou esta entrega pode finaliza-la.');
        }

        $delivery->update([
            'delivery_status_id' => 3,
            'delivery_time' => now()->toDateTimeString(),
            'delivered_at' => now()->toDateTimeString(),
        ]);
    }

    public function getHistory(): LengthAwarePaginator
    {
        return Delivery::CourierBy()->paginate(10);
    }
}
