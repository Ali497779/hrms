<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'total_pay',
        'generated_at',
    ];
}
