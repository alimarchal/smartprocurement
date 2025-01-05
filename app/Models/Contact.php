<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'designation', 'phone', 'email'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function deliveryNotesReceived()
    {
        return $this->hasMany(DeliveryNote::class, 'received_by');
    }

    public function deliveryNotesDelivered()
    {
        return $this->hasMany(DeliveryNote::class, 'delivered_by');
    }

}
