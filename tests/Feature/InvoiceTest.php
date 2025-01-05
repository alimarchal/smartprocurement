<?php
use App\Models\Invoice;
use App\Models\DeliveryNote;
use App\Models\Company;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can create invoice from delivery note', function () {
    $deliveryNote = DeliveryNote::factory()
        ->has(DeliveryNoteItem::factory()->count(2))
        ->create(['delivery_status' => 'delivered']);

    $invoiceData = [
        'delivery_note_id' => $deliveryNote->id,
        'company_id' => $deliveryNote->company_id,
        'invoice_date' => now()->format('Y-m-d'),
        'due_date' => now()->addDays(30)->format('Y-m-d'),
        'currency' => 'SAR',
        'vat_rate' => 15,
        'items' => $deliveryNote->items->map(fn($item) => [
            'id' => $item->item_id,
            'quantity' => $item->quantity,
            'unit_price' => $item->item->unit_price
        ])->toArray()
    ];

    $response = $this->post(route('invoices.store'), $invoiceData);
    $response->assertRedirect();

    $invoice = Invoice::latest()->first();
    expect($invoice->items)->toHaveCount(2);
});

test('calculates payment status correctly', function () {
    $invoice = Invoice::factory()->create([
        'total' => 1000,
        'paid_amount' => 0
    ]);

    $invoice->payments()->create([
        'payment_date' => now(),
        'amount' => 500,
        'payment_method' => 'bank_transfer',
        'status' => 'completed'
    ]);

    expect($invoice->paid_amount)->toBe(500)
        ->and($invoice->balance)->toBe(500)
        ->and($invoice->status)->toBe('partial');
});

test('cannot update invoice with payments', function () {
    $invoice = Invoice::factory()
        ->has(Payment::factory())
        ->create();

    $response = $this->put(route('invoices.update', $invoice), [
        'due_date' => now()->addDays(30)
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error');
});
