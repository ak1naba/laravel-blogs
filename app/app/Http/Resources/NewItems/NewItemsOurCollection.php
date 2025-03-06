<?php

namespace App\Http\Resources\NewItems;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewItemsOurCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($newItem) {
            return new NewItemLightResource($newItem);
        })->toArray();
    }
}
