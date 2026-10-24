<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'description' => $this->description,

            'specifications' => [
                'groupset' => $this->groupset,
                'brakes' => $this->brakes,
                'wheelset' => $this->wheelset,
                'tires' => $this->tires,
                'crankset' => $this->crankset,
            ],

            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category?->id,
                    'name' => $this->category?->name,
                ];
            }),
        ];
    }
}