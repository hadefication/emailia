<?php

namespace Hadefication\Emailia\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailLog extends Model
{
    use HasFactory;

    protected $table = 'emailia_email_logs';
    
    protected $fillable = [
        'details',
        'read'
    ];

    protected $casts = [
        'details' => 'array',
        'read' => 'boolean'
    ];
}