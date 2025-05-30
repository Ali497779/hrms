<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'createdby',
        'product',
        'qty',
        'price',
        'total',
        'invoice_description',
        'sub_total',
        'tax_percent',
        'tax_amount',
        'total_amount',
        'issue_date',
        'invoice_stripe_id',
        'invoice_payment_link'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function createdby(){
        return $this->belongsTo(User::class, 'createdby', 'id');
    }
}
