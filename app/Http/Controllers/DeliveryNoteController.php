<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryNoteRequest;
use App\Http\Requests\UpdateDeliveryNoteRequest;
use App\Models\DeliveryNote;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Quotation;

class DeliveryNoteController extends Controller
{
    public function index()
    {
        $deliveryNotes = DeliveryNote::with(['company', 'creator', 'quotation'])
            ->orderByDesc('delivery_date')
            ->paginate(10);
        return view('delivery-notes.index', compact('deliveryNotes'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id');
        $quotations = Quotation::whereDoesntHave('deliveryNotes')
            ->where('status', 'accepted')
            ->get();
        return view('delivery-notes.create', compact('companies', 'quotations'));
    }

    public function store(StoreDeliveryNoteRequest $request)
    {
        $deliveryNote = DeliveryNote::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->id()]
        ));

        foreach ($request->items as $item) {
            $deliveryNote->items()->create([
                'item_id' => $item['id'],
                'quantity' => $item['quantity']
            ]);
        }

        return redirect()->route('delivery-notes.show', $deliveryNote)
            ->with('success', 'Delivery note created');
    }

    public function show(DeliveryNote $deliveryNote)
    {
        $deliveryNote->load([
            'company',
            'creator',
            'quotation',
            'items.item',
            'receiver',
            'deliverer',
            'invoice'
        ]);
        return view('delivery-notes.show', compact('deliveryNote'));
    }

    public function edit(DeliveryNote $deliveryNote)
    {
        if ($deliveryNote->invoice || $deliveryNote->delivery_status === 'delivered') {
            return back()->with('error', 'Cannot edit delivered or invoiced note');
        }

        $companies = Company::orderBy('name')->pluck('name', 'id');
        $contacts = $deliveryNote->company->contacts()->get();
        return view('delivery-notes.edit', compact('deliveryNote', 'companies', 'contacts'));
    }

    public function update(UpdateDeliveryNoteRequest $request, DeliveryNote $deliveryNote)
    {
        if ($deliveryNote->invoice || $deliveryNote->delivery_status === 'delivered') {
            return back()->with('error', 'Cannot update delivered or invoiced note');
        }

        $deliveryNote->update($request->validated());

        if ($request->has('items')) {
            $deliveryNote->items()->delete();
            foreach ($request->items as $item) {
                $deliveryNote->items()->create([
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
            }
        }

        return redirect()->route('delivery-notes.show', $deliveryNote)
            ->with('success', 'Delivery note updated');
    }

    public function destroy(DeliveryNote $deliveryNote)
    {
        if ($deliveryNote->invoice || $deliveryNote->delivery_status === 'delivered') {
            return back()->with('error', 'Cannot delete delivered or invoiced note');
        }

        $deliveryNote->items()->delete();
        $deliveryNote->delete();

        return redirect()->route('delivery-notes.index')
            ->with('success', 'Delivery note deleted');
    }
}
