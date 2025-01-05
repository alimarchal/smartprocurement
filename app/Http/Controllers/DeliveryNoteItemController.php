<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryNoteItemRequest;
use App\Http\Requests\UpdateDeliveryNoteItemRequest;
use App\Models\DeliveryNoteItem;

class DeliveryNoteItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryNoteItem $deliveryNoteItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryNoteItem $deliveryNoteItem)
    {
        //
    }

    public function store(StoreDeliveryNoteItemRequest $request, DeliveryNote $deliveryNote)
    {
        $item = $deliveryNote->items()->create($request->validated());
        return response()->json($item);
    }

    public function update(UpdateDeliveryNoteItemRequest $request, DeliveryNoteItem $item)
    {
        $item->update($request->validated());
        return response()->json($item);
    }

    public function destroy(DeliveryNoteItem $item)
    {
        $item->delete();
        return response()->json(['success' => true]);
    }
}
