<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $primaryKey = 'feedback_ID';

    public $timestamps = false;

    protected $fillable = [
        'repairs_ID',
        'submitted_by',
        'feedback_content',
        'rate',
    ];
}
