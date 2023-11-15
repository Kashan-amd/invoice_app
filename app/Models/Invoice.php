<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'invoice_number', 'invoice_date', 'amount', 'description', 'image',
    ];
        
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function invoiceItems(){
        return $this->hasMany(InvoiceItem::class);
    }
}
