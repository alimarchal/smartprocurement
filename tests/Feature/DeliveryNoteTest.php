<?php
use App\Models\DeliveryNote;
use App\Models\Quotation;
use App\Models\Company;
use App\Models\Item;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can create delivery note with items', function () {
    $company = Company::factory()->create();
    $items = Item::factory(2)->create();

    $deliveryNoteData = [
        'company_id' => $company->id,
        'delivery_date' => now()->format('Y-m-d'),
        'delivery_status' => 'pending',
        'items' => $items->map(fn($item) => [
            'id' => $item->id,
            'quantity' => 2
        ])->toArray()
    ];

    $response = $this->post(route('delivery-notes.store'), $deliveryNoteData);
    $response->assertRedirect();

    $deliveryNote = DeliveryNote::latest()->first();
    expect($deliveryNote->items)->toHaveCount(2);
});

test('updates stock on delivery note creation', function () {
    $item = Item::factory()->create(['stock' => 10]);

    $deliveryNoteData = [
        'company_id' => Company::factory()->create()->id,
        'delivery_date' => now()->format('Y-m-d'),
        'items' => [[
            'id' => $item->id,
            'quantity' => 2
        ]]
    ];

    $this->post(route('delivery-notes.store'), $deliveryNoteData);

    $item->refresh();
    expect($item->stock)->toBe(8);
});

test('cannot update delivered note', function () {
    $deliveryNote = DeliveryNote::factory()->create([
        'delivery_status' => 'delivered'
    ]);

    $response = $this->put(route('delivery-notes.update', $deliveryNote), [
        'delivery_status' => 'pending'
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error');
});
