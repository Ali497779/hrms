<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatAttachment extends Model
{
    use HasFactory;
    protected $table = 'chat_attachments';
    protected $fillable = [
        'project_id',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
    ];
}
