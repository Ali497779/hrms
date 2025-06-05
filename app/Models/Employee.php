<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'salary',
        'comission',
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