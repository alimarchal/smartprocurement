<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryNoteRequest extends FormRequest
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
            'po_number' => 'nullable|string|max:50',
            'delivery_date' => 'required|date',
            'delivery_status' => 'required|in:pending,delivered,rejected',
            'received_by' => 'nullable|exists:contacts,id',
            'delivered_by' => 'nullable|exists:contacts,id',
            'received_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1'
        ];
    }
}
