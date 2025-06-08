<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

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
        'weight',
    ];

    protected $attributes = [
        'status' => 'Pending',
    ];

    protected $casts = [
        'weight' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke pelapor (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    // 🔁 Tambahan: Relasi ke tabel repairs (jika satu laporan bisa punya satu atau lebih perbaikan)
    public function repairs()
    {
        return $this->hasMany(Repair::class, 'facility_report_id', 'report_ID');
    }

    public function alternatives()
{
    return $this->hasMany(AlternativeTopsis::class, 'report_id');

}

    protected static function booted()
    {
        static::deleting(function ($report) {
            // Deleting each repair individually triggers their model events (for deleting feedback)
            $report->repairs()->each(function($repair) {
                $repair->delete();
            });
            $report->alternatives()->delete();
        });
    }

}
