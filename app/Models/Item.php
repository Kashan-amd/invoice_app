<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'unit', 'description', 'sale_rate', 'purchase_rate', 'quantity'
    ];

    public function invoiceItems(){
        return $this->hasMany(InvoiceItem::class);
    }
}
