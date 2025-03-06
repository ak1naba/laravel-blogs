<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewItem\StoreRequest;
use App\Http\Resources\NewItems\NewItemResource;
use App\Http\Resources\NewItems\NewItemsCollection;
use App\Models\NewItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newItems = NewItem::where('user_id', Auth::id())->paginate(10);

        return response()->json([
            'data' => new NewItemsCollection($newItems),
            'links' => [
                'prev' => $newItems->previousPageUrl(),
                'next' => $newItems->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $newItems->currentPage(),
                'from' => $newItems->firstItem(),
                'last_page' => $newItems->lastPage(),
                'per_page' => $newItems->perPage(),
                'to' => $newItems->lastItem(),
                'total' => $newItems->total(),
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $newItem = NewItem::create([
           'title'=>$request->title,
           'text'=>$request->text,
           'published'=>$request->published,
           'user_id'=>Auth::id(),
        ]);

        return response()->json(['newItem' => new NewItemResource($newItem)], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(NewItem $newItem)
    {
        return response()->json(['newItem' => new NewItemResource($newItem)], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewItem $newItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewItem $newItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewItem $newItem)
    {
        //
    }
}
