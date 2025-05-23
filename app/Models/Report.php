<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Optional if your table name is non-standard
    protected $table = 'report';

    protected $primaryKey = 'report_ID';

    protected $fillable = [
        'user_ID',
        'priority_Assignment',
        'facility_name',
        'location',
        'description',
        'category',
        'picture_proof',
        'status',
    ];

    // Default attributes
    protected $attributes = [
        'status' => 'Pending',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];


    // You can add a relationship for priority if needed
    // public function priority()
    // {
    //     return $this->belongsTo(Priority::class, 'priority_Assignment');
    // }
}
