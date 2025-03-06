<?php

namespace App\Http\Resources\NewItems;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewItemLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $request->title,
            'author' => $request->user->name,
        ];
    }
}
