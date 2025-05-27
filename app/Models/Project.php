<?php

namespace App\Models;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $table = "projects";
    protected $fillable = [
        'title',
        'description',
        'customer_id',
        'type',
        'start_date',
        'end_date',
        'status',
        'attachments',
        'created_by',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function createdby(){
        return $this->belongsTo(User::class,'id','created_by');
    }
}
