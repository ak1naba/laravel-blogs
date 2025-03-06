<?php

namespace App\Observers\User;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function deleting(User $user): void
    {
        $user->newItems()->update(['published' => false]);
    }
}
