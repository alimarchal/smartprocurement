<?php
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\Item;

test('can create invoice item', function () {
    $invoice = Invoice::factory()->create();
    $item = Item::factory()->create(['unit_price' => 100]);

    $response = $this->post("/invoice-items", [
        'invoice_id' => $invoice->id,
        'item_id' => $item->id,
        'quantity' => 2,
        'unit_price' => 100
    ]);

    $response->assertSuccessful();
    expect(InvoiceItem::count())->toBe(1)
        ->and(InvoiceItem::first()->total)->toBe(200);
});

test('updates invoice totals', function () {
    $invoice = Invoice::factory()->create(['vat_rate' => 15]);
    $invoiceItem = InvoiceItem::factory()->create([
        'invoice_id' => $invoice->id,
        'quantity' => 1,
        'unit_price' => 100
    ]);

    $response = $this->put("/invoice-items/{$invoiceItem->id}", [
        'quantity' => 2,
        'unit_price' => 100
    ]);

    $invoice->refresh();
    expect($invoice->subtotal)->toBe(200)
        ->and($invoice->vat_amount)->toBe(30);
});

test('deletes invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->create();

    $response = $this->delete("/invoice-items/{$invoiceItem->id}");

    $response->assertSuccessful();
    $this->assertModelMissing($invoiceItem);
});
