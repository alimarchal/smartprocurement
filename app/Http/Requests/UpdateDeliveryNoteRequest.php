<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'delivery_status' => 'required|in:pending,delivered,rejected',
            'received_by' => 'nullable|exists:contacts,id',
            'delivered_by' => 'nullable|exists:contacts,id',
            'received_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'items' => 'sometimes|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1'
        ];
    }
}
