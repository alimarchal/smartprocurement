<?php
use App\Models\Item;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list items', function () {
    $items = Item::factory(3)->create();
    $response = $this->get(route('items.index'));
    $response->assertOk();
    $items->each(fn($item) => $response->assertSee($item->name));
});

test('can create item', function () {
    $itemData = Item::factory()->raw();
    $response = $this->post(route('items.store'), $itemData);
    $response->assertRedirect();
    $this->assertDatabaseHas('items', $itemData);
});

test('can update item', function () {
    $item = Item::factory()->create();
    $updateData = [
        'name' => 'Updated Item',
        'unit_price' => 100.00
    ];
    $response = $this->put(route('items.update', $item), $updateData);
    $response->assertRedirect();
    $this->assertDatabaseHas('items', $updateData);
});

test('cannot delete item with associated records', function () {
    $item = Item::factory()
        ->has(QuotationItem::factory())
        ->create();
    $response = $this->delete(route('items.destroy', $item));
    $response->assertRedirect();
    $this->assertModelExists($item);
});
