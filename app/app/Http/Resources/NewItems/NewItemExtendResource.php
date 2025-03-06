<?php

namespace App\Http\Resources\NewItems;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewItemExtendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'text' => $this->title,
            'author' => $this->user ? $this->user->name : null,
        ];
    }
}
