<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $primaryKey = 'repair_ID';

    public $timestamps = false;

    protected $fillable = [
        'facility_report_id',
        'technician_id',
        'repair_status',
        'notes',
    ];


    public function report()
    {
        return $this->belongsTo(Report::class, 'facility_report_id', 'report_ID');
    }

    // Relasi ke user sebagai teknisi
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
