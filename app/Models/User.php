<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\Attendance;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'is_admin',
        'is_customer',
        'is_sales',
        'is_projectmanager',
        'is_developer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        if ($this->is_admin) return 'admin';
        if ($this->is_customer) return 'customer';
        if ($this->is_sales) return 'sales';
        if ($this->is_projectmanager) return 'projectmanager';
        if ($this->is_developer) return 'developer';
        return 'user';
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class,'user_id', 'id');
    }

}
