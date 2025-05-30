<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'created_by',
        'stripe_customer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdby(){
        return $this->belongsTo(User::class,'id', 'created_by');
    }

    public function project(){
        return $this->hasMany(Project::class,'customer_id','id');
    }
}
