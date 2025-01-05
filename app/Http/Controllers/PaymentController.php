<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\Invoice;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['invoice', 'company'])
            ->orderByDesc('payment_date')
            ->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $invoices = Invoice::whereIn('status', ['unpaid', 'partial'])
            ->with('company')
            ->get();
        return view('payments.create', compact('invoices'));
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->id()]
        ));

        $payment->invoice->updatePaymentStatus();

        return redirect()->route('payments.show', $payment);
    }

    public function show(Payment $payment)
    {
        $payment->load(['invoice.company', 'creator']);
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        if ($payment->status === 'completed') {
            return back()->with('error', 'Cannot edit completed payment');
        }
        return view('payments.edit', compact('payment'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        if ($payment->status === 'completed') {
            return back()->with('error', 'Cannot update completed payment');
        }

        $payment->update($request->validated());
        $payment->invoice->updatePaymentStatus();

        return redirect()->route('payments.show', $payment);
    }

    public function destroy(Payment $payment)
    {
        if ($payment->status === 'completed') {
            return back()->with('error', 'Cannot delete completed payment');
        }

        $invoice = $payment->invoice;
        $payment->delete();
        $invoice->updatePaymentStatus();

        return redirect()->route('payments.index');
    }
}
