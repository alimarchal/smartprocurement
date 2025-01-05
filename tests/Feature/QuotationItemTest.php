<?php
use App\Models\QuotationItem;
use App\Models\Quotation;
use App\Models\Item;

test('can create quotation item', function () {
    $quotation = Quotation::factory()->create();
    $item = Item::factory()->create(['unit_price' => 100]);

    $response = $this->post("/quotation-items", [
        'quotation_id' => $quotation->id,
        'item_id' => $item->id,
        'quantity' => 2
    ]);

    $response->assertSuccessful();
    expect(QuotationItem::count())->toBe(1)
        ->and(QuotationItem::first()->total)->toBe(200);
});

test('updates quotation totals', function () {
    $quotation = Quotation::factory()->create(['vat_rate' => 15]);
    $item = Item::factory()->create(['unit_price' => 100]);

    $quotationItem = QuotationItem::factory()->create([
        'quotation_id' => $quotation->id,
        'item_id' => $item->id,
        'quantity' => 1
    ]);

    $response = $this->put("/quotation-items/{$quotationItem->id}", [
        'quantity' => 2
    ]);

    $quotation->refresh();
    expect($quotation->subtotal)->toBe(200)
        ->and($quotation->vat_amount)->toBe(30);
});

test('deletes quotation item', function () {
    $quotationItem = QuotationItem::factory()->create();

    $response = $this->delete("/quotation-items/{$quotationItem->id}");

    $response->assertSuccessful();
    $this->assertModelMissing($quotationItem);
});
