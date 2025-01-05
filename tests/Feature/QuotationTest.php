<?php
use App\Models\Quotation;
use App\Models\Company;
use App\Models\Item;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can create quotation with items', function () {
    $company = Company::factory()->create();
    $items = Item::factory(2)->create();

    $quotationData = [
        'company_id' => $company->id,
        'quotation_date' => now()->format('Y-m-d'),
        'valid_until' => now()->addDays(30)->format('Y-m-d'),
        'currency' => 'SAR',
        'vat_rate' => 15,
        'items' => $items->map(fn($item) => [
            'id' => $item->id,
            'quantity' => 2
        ])->toArray()
    ];

    $response = $this->post(route('quotations.store'), $quotationData);
    $response->assertRedirect();

    $quotation = Quotation::latest()->first();
    expect($quotation->items)->toHaveCount(2);
});

test('cannot update quotation with delivery notes', function () {
    $quotation = Quotation::factory()
        ->has(DeliveryNote::factory())
        ->create();

    $response = $this->put(route('quotations.update', $quotation), [
        'company_id' => $quotation->company_id,
        'quotation_date' => now()
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('calculates totals correctly', function () {
    $quotation = Quotation::factory()->create([
        'vat_rate' => 15,
        'discount' => 100
    ]);

    $item = Item::factory()->create(['unit_price' => 1000]);

    $quotation->items()->create([
        'item_id' => $item->id,
        'quantity' => 2,
        'unit_price' => $item->unit_price
    ]);

    $quotation->calculateTotals();

    expect($quotation->subtotal)->toBe(2000)
        ->and($quotation->vat_amount)->toBe(300)
        ->and($quotation->total)->toBe(2200);
});
