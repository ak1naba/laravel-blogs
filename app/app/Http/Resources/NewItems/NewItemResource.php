<?php

namespace App\Http\Resources\NewItems;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'published' => $this->published,
        ];
    }
}
