<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'payment_number', 'invoice_id', 'company_id', 'created_by',
        'payment_date', 'amount', 'payment_method', 'reference_number',
        'bank_name', 'notes', 'status'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($payment) {
            if ($payment->status === 'completed') {
                $payment->invoice->updatePaymentStatus();
            }
        });
        static::creating(function ($payment) {
            $payment->payment_number = 'PAY-' . date('Y') . sprintf('%06d', static::count() + 1);
        });
    }
}
