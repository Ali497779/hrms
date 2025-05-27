<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectMember extends Model
{
    use HasFactory;
    protected $table = 'project_members';
    protected $fillable = [
        'project_id',
        'employee_id',
        'status',
        'created_by'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
