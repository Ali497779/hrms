<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'username',
        'phone',
        'company',
        'designation',
        'website',
        'vat',
        'address',
        'about',
        'date_of_birth',
        'country',
        'state',
        'city',
        'time_zone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // public function setDesignationAttribute($value)
    // {
    //     $this->attributes['designation'] = $value;
    //     $this->user->update([
    //         'is_sales' => $value === 'sales',
    //         'is_developer' => $value === 'developer',
    //         'is_projectmanager' => $value === 'projectmanager',
    //     ]);
    // }
}