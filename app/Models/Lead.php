<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'leads';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'buisness',
        'website',
        'service',
        'amount',
        'remark',
        'status',
        'source',
        'created_by'
    ];

    public function createdby(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
