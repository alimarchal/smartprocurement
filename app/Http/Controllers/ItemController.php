<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('name')
            ->withCount(['quotationItems', 'deliveryNoteItems', 'invoiceItems'])
            ->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());
        return redirect()->route('items.show', $item)
            ->with('success', 'Item created successfully');
    }

    public function show(Item $item)
    {
        $item->load(['quotationItems.quotation', 'deliveryNoteItems.deliveryNote', 'invoiceItems.invoice']);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());
        return redirect()->route('items.show', $item)
            ->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        if ($item->quotationItems()->exists() ||
            $item->deliveryNoteItems()->exists() ||
            $item->invoiceItems()->exists()) {
            return back()->with('error', 'Cannot delete item with associated records');
        }
        $item->delete();
        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
}
