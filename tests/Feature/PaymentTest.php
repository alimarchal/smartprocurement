<?php
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can create payment', function () {
    $invoice = Invoice::factory()->create([
        'total' => 1000,
        'paid_amount' => 0
    ]);

    $paymentData = [
        'invoice_id' => $invoice->id,
        'company_id' => $invoice->company_id,
        'payment_date' => now()->format('Y-m-d'),
        'amount' => 500,
        'payment_method' => 'bank_transfer',
        'reference_number' => '12345',
        'status' => 'completed'
    ];

    $response = $this->post(route('payments.store'), $paymentData);
    $response->assertRedirect();

    $payment = Payment::latest()->first();
    expect($payment->amount)->toBe(500);
});

test('cannot exceed invoice balance', function () {
    $invoice = Invoice::factory()->create([
        'total' => 1000,
        'paid_amount' => 500
    ]);

    $paymentData = [
        'invoice_id' => $invoice->id,
        'company_id' => $invoice->company_id,
        'payment_date' => now()->format('Y-m-d'),
        'amount' => 600,
        'payment_method' => 'bank_transfer',
        'reference_number' => '12345',
        'status' => 'completed'
    ];

    $response = $this->post(route('payments.store'), $paymentData);
    $response->assertSessionHasErrors('amount');
});

test('updates invoice status on payment', function () {
    $invoice = Invoice::factory()->create([
        'total' => 1000,
        'paid_amount' => 0
    ]);

    $payment = Payment::factory()->create([
        'invoice_id' => $invoice->id,
        'amount' => 1000,
        'status' => 'completed'
    ]);

    $invoice->refresh();
    expect($invoice->status)->toBe('paid');
});
