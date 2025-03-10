<?php

namespace App\DTOs\NewItem;

use Illuminate\Support\Facades\Auth;

class PostCreateDTO
{
    private string $title;
    private string $text;
    private bool $published;
    private int $user_id;

    public function __construct(array $data)
    {
        $this->title = $data['title'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->published = $data['published'] ?? null;
        $this->user_id = Auth::id();
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
            'published' => $this->published,
            'user_id' => $this->user_id,
        ];
    }
}
