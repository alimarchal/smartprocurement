<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'quotation_date' => 'required|date',
            'valid_until' => 'required|date|after:quotation_date',
            'payment_terms' => 'nullable|string|max:255',
            'currency' => 'required|string|size:3',
            'vat_rate' => 'required|numeric|between:0,100',
            'discount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'status' => 'required|in:draft,sent,accepted,rejected'
        ];
    }
}
