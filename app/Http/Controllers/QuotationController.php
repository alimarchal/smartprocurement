<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;
use App\Models\Quotation;
use App\Models\Company;
use App\Models\Item;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with(['company', 'creator'])
            ->orderByDesc('quotation_date')
            ->paginate(10);
        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id');
        $items = Item::where('is_active', true)->orderBy('name')->get();
        return view('quotations.create', compact('companies', 'items'));
    }

    public function store(StoreQuotationRequest $request)
    {
        $quotation = Quotation::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->id()]
        ));

        foreach ($request->items as $item) {
            $quotation->items()->create([
                'item_id' => $item['id'],
                'quantity' => $item['quantity']
            ]);
        }

        $quotation->calculateTotals();

        return redirect()->route('quotations.show', $quotation)
            ->with('success', 'Quotation created successfully');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load(['company', 'creator', 'items.item', 'deliveryNotes', 'invoice']);
        return view('quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        if ($quotation->invoice || $quotation->deliveryNotes()->exists()) {
            return back()->with('error', 'Cannot edit quotation with associated records');
        }

        $companies = Company::orderBy('name')->pluck('name', 'id');
        $items = Item::where('is_active', true)->orderBy('name')->get();
        return view('quotations.edit', compact('quotation', 'companies', 'items'));
    }

    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        if ($quotation->invoice || $quotation->deliveryNotes()->exists()) {
            return back()->with('error', 'Cannot update quotation with associated records');
        }

        $quotation->update($request->validated());

        // Update items
        $quotation->items()->delete();
        foreach ($request->items as $item) {
            $quotation->items()->create([
                'item_id' => $item['id'],
                'quantity' => $item['quantity']
            ]);
        }

        $quotation->calculateTotals();

        return redirect()->route('quotations.show', $quotation)
            ->with('success', 'Quotation updated successfully');
    }

    public function destroy(Quotation $quotation)
    {
        if ($quotation->invoice || $quotation->deliveryNotes()->exists()) {
            return back()->with('error', 'Cannot delete quotation with associated records');
        }

        $quotation->items()->delete();
        $quotation->delete();

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation deleted successfully');
    }
}
