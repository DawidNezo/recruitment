<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'restaurants' => RestaurantResource::collection($this->whenLoaded('restaurants')),
            'restaurant_ids' => $this->whenLoaded('restaurants', function () {
                return $this->restaurants->pluck('id');
            }),
        ];
    }
}
