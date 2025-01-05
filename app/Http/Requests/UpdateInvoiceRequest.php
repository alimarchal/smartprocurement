<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'payment_terms' => 'nullable|string|max:255',
            'due_date' => 'required|date|after:invoice_date',
            'discount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ];
    }
}
