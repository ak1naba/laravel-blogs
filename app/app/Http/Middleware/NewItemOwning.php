<?php

namespace App\Http\Middleware;

use App\Models\NewItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NewItemOwning
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $newItem =$request->route('new_item');

        if ($newItem->user_id != Auth::user()->id) {
            if (Auth::user()->role != 'admin') {
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        return $next($request);
    }

}
