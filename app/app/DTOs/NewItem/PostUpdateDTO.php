<?php

namespace App\DTOs\NewItem;

use Illuminate\Support\Facades\Auth;

class PostUpdateDTO
{
    private string $title;
    private string $text;
    private bool $published;


    public function __construct(array $data)
    {
        $this->title = $data['title'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->published = $data['published'] ?? null;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
            'published' => $this->published,
        ];
    }
}
