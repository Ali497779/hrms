<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payrolls';
    protected $fillable = [
        'user_id',
        'month',
        'base_salary',
        'commission',
        'deduction',
        'total_tax',
        'total_pay',
        'generated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
