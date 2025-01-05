<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryNoteItemRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array
    {
        return [
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1'
        ];
    }
}
