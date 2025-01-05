<?php
use App\Models\DeliveryNoteItem;
use App\Models\DeliveryNote;
use App\Models\Item;

test('can create delivery note item', function () {
    $deliveryNote = DeliveryNote::factory()->create();
    $item = Item::factory()->create(['stock' => 10]);

    $response = $this->post("/delivery-note-items", [
        'delivery_note_id' => $deliveryNote->id,
        'item_id' => $item->id,
        'quantity' => 2
    ]);

    $response->assertSuccessful();
    $item->refresh();
    expect($item->stock)->toBe(8);
});

test('updates stock on delete', function () {
    $item = Item::factory()->create(['stock' => 8]);
    $deliveryNoteItem = DeliveryNoteItem::factory()->create([
        'item_id' => $item->id,
        'quantity' => 2
    ]);

    $this->delete("/delivery-note-items/{$deliveryNoteItem->id}");

    $item->refresh();
    expect($item->stock)->toBe(10);
});
