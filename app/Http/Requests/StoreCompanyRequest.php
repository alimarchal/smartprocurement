<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            // Basic Information
            'name' => 'required|string|max:255',
            'name_arabic' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:companies',
            'cr_number' => 'nullable|string|max:50|unique:companies',
            'vat_number' => 'nullable|string|max:50',
            'vat_number_arabic' => 'nullable|string|max:50',

            // Contact Information
            'cell' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',

            // Business Details
            'customer_industry' => 'nullable|in:Regular,Industrial,Commercial',
            'sale_type' => 'nullable|in:Manual,Automated',
            'article_no' => 'nullable|string|max:50',
            'business_type_english' => 'nullable|string|max:255',
            'business_type_arabic' => 'nullable|string|max:255',
            'business_description_english' => 'nullable|string',
            'business_description_arabic' => 'nullable|string',

            // Invoice Settings
            'invoice_side_english' => 'nullable|string|max:255',
            'invoice_side_arabic' => 'nullable|string|max:255',
            'english_description' => 'nullable|string|max:255',
            'arabic_description' => 'nullable|string|max:255',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'apply_discount_type' => 'nullable|in:Before,After',
            'language' => 'nullable|in:english,arabic',
            'show_email_on_invoice' => 'nullable|boolean',

            // Additional Information
            'website' => 'nullable|url|max:255',
            'company_type' => 'required|in:customer,vendor',
            'bank_name' => 'nullable|string|max:100',
            'iban' => 'nullable|string|max:50|unique:companies',

//             File Uploads
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'company_stamp' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120' // 5MB max
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Convert checkbox to boolean
        $this->merge([
            'show_email_on_invoice' => $this->has('show_email_on_invoice')
        ]);
    }
}
