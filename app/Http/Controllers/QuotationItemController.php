<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationItemRequest;
use App\Http\Requests\UpdateQuotationItemRequest;
use App\Models\Quotation;
use App\Models\QuotationItem;

class QuotationItemController extends Controller
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
    public function show(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationItem $quotationItem)
    {
        //
    }

    public function store(StoreQuotationItemRequest $request, Quotation $quotation)
    {
        $item = $quotation->items()->create($request->validated());
        $quotation->calculateTotals();
        return response()->json($item);
    }

    public function update(UpdateQuotationItemRequest $request, QuotationItem $item)
    {
        $item->update($request->validated());
        $item->quotation->calculateTotals();
        return response()->json($item);
    }

    public function destroy(QuotationItem $item)
    {
        $quotation = $item->quotation;
        $item->delete();
        $quotation->calculateTotals();
        return response()->json(['success' => true]);
    }
}
