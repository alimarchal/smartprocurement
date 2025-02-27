<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'vat_number' => 'nullable|string|max:15|unique:companies,vat_number,'.$this->company->id,
            'cr_number' => 'nullable|string|max:15|unique:companies,cr_number,'.$this->company->id,
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:companies,email,'.$this->company->id,
            'website' => 'nullable|url|max:255',
            'iban' => 'nullable|string|max:50|unique:companies,iban,'.$this->company->id,
            'bank_name' => 'nullable|string|max:100',
            'company_type' => 'required|in:customer,vendor'
        ];
    }
}
