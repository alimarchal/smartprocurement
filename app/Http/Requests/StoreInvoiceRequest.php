<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'delivery_note_id' => 'nullable|exists:delivery_notes,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after:invoice_date',
            'payment_terms' => 'nullable|string|max:255',
            'currency' => 'required|string|size:3',
            'vat_rate' => 'required|numeric|between:0,100',
            'discount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ];
    }
}
