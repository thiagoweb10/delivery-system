<?php

namespace App\Http\Requests\Courier;

use App\DTOs\AcceptDeliveryDTO;
use App\Models\Delivery;
use Illuminate\Foundation\Http\FormRequest;

class AcceptDeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        ];
    }

    public function toDTO(Delivery $delivery): AcceptDeliveryDTO
    {
        return new AcceptDeliveryDTO(
            deliveryId: $delivery->id,
            courierId: authUserId(),
        );
    }
}
