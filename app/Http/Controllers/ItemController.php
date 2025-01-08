<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('company_id', auth()->user()->company->id)
            ->with('category')
            ->latest()
            ->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::where('company_id', auth()->user()->company->id)
            ->where('status', true)
            ->get();
        return view('items.create', compact('categories'));
    }

    public function store(StoreItemRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        $validatedData['company_id'] = auth()->user()->company->id;

        Item::create($validatedData);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = Category::where('company_id', auth()->user()->company->id)
            ->where('status', true)
            ->get();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        $validatedData['company_id'] = auth()->user()->company->id;

        $item->update($validatedData);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
}
