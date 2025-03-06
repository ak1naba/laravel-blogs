<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewItem\StoreRequest;
use App\Http\Resources\NewItems\NewItemExtendResource;
use App\Http\Resources\NewItems\NewItemResource;
use App\Http\Resources\NewItems\NewItemsCollection;
use App\Http\Resources\NewItems\NewItemsOurCollection;
use App\Models\NewItem;
use App\Models\User;
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
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, NewItem $newItem)
    {
        $newItem->update([
            'title'=>$request->title,
            'text'=>$request->text,
            'published'=>$request->published,
        ]);

        return response()->json(['newItem' => new NewItemResource($newItem)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewItem $newItem)
    {
        $newItem->delete();

        return response()->json(['message' => 'Post is deleted'], 200);
    }

    public function getNewItems()
    {
        $newItems = NewItem::where('published', true)->with('user')->paginate(10);

        return response()->json([
            'data' => new NewItemsOurCollection($newItems),
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

    public function getNewItem(NewItem $newItem)
    {
        if(!$newItem->published){
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json(['newItem' => new NewItemExtendResource($newItem->loadMissing('user'))], 200);

    }
}
