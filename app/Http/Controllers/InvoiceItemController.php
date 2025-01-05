<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceItemRequest;
use App\Http\Requests\UpdateInvoiceItemRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceItemController extends Controller
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
    public function show(InvoiceItem $invoiceItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceItem $invoiceItem)
    {
        //
    }
    public function store(StoreInvoiceItemRequest $request, Invoice $invoice)
    {
        $item = $invoice->items()->create($request->validated());
        $invoice->calculateTotals();
        return response()->json($item);
    }

    public function update(UpdateInvoiceItemRequest $request, InvoiceItem $item)
    {
        $item->update($request->validated());
        $item->invoice->calculateTotals();
        return response()->json($item);
    }

    public function destroy(InvoiceItem $item)
    {
        $invoice = $item->invoice;
        $item->delete();
        $invoice->calculateTotals();
        return response()->json(['success' => true]);
    }
}
