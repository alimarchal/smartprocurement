<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'payment_date' => 'required|date',
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) {
                    $invoice = $this->payment->invoice;
                    $currentBalance = $invoice->balance + $this->payment->amount;
                    if ($value > $currentBalance) {
                        $fail('Payment amount cannot exceed invoice balance.');
                    }
                },
            ],
            'payment_method' => 'required|in:bank_transfer,cash,cheque',
            'reference_number' => 'required_if:payment_method,bank_transfer,cheque',
            'bank_name' => 'required_if:payment_method,bank_transfer,cheque',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,completed,failed'
        ];
    }
}
