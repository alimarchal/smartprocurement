<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'vat_number', 'cr_number', 'address', 'city', 'country',
        'phone', 'email', 'website', 'iban', 'bank_name', 'company_type'
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function deliveryNotes()
    {
        return $this->hasMany(DeliveryNote::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->country}";
    }
}
