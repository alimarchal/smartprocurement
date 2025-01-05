<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\DeliveryNote;
use App\Models\Quotation;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['company', 'creator'])
            ->orderByDesc('invoice_date')
            ->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $deliveryNotes = DeliveryNote::whereDoesntHave('invoice')
            ->where('delivery_status', 'delivered')
            ->with(['company', 'items'])
            ->get();

        return view('invoices.create', compact('deliveryNotes'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $invoice = Invoice::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->id()]
        ));

        foreach ($request->items as $item) {
            $invoice->items()->create([
                'item_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price']
            ]);
        }

        $invoice->calculateTotals();

        return redirect()->route('invoices.show', $invoice);
    }

    public function show(Invoice $invoice)
    {
        $invoice->load([
            'company',
            'quotation',
            'deliveryNote',
            'items.item',
            'payments'
        ]);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        if ($invoice->payments()->exists()) {
            return back()->with('error', 'Cannot edit invoice with payments');
        }

        return view('invoices.edit', compact('invoice'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        if ($invoice->payments()->exists()) {
            return back()->with('error', 'Cannot update invoice with payments');
        }

        $invoice->update($request->validated());
        $invoice->calculateTotals();

        return redirect()->route('invoices.show', $invoice);
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->payments()->exists()) {
            return back()->with('error', 'Cannot delete invoice with payments');
        }

        $invoice->items()->delete();
        $invoice->delete();

        return redirect()->route('invoices.index');
    }
}
