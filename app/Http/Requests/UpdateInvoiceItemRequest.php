<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0'
        ];
    }
}
