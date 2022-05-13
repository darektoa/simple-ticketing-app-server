<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $destinationLoaded  = $this->relationLoaded('destination');
        $addonLoaded        = $this->relationLoaded('addon');

        return [
            'id'            => $this->id,
            'code'          => $this->code,
            'amount'        => $this->amount,
            'status'        => [
                'id'    => $this->status,
                'name'  => $this->status_name,
            ],
            'type'          => [
                'id'    => $this->type,
                'name'  => $this->type_name,
            ],
            'sender'        => UserResource::make($this->whenLoaded('sender')),
            'receiver'      => UserResource::make($this->whenLoaded('receiver')),
            'destination'   => DestinationResource::make($this->when($destinationLoaded, $this->destination->destination)),
            'addons'        => AddonResource::make($this->when($addonLoaded, $this->addon->addon)),
            'detail'        => $this->detail,
        ];
    }
}
