<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'description', 'category', 'unit',
        'unit_price', 'stock', 'is_active'
    ];

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function deliveryNoteItems()
    {
        return $this->hasMany(DeliveryNoteItem::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function updateStock($quantity, $type = 'add')
    {
        $this->stock = $type === 'add' ? $this->stock + $quantity : $this->stock - $quantity;
        $this->save();
    }
}
