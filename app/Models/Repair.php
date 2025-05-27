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
        'priority_Assignment', // ✅ Add this line
        'repair_status',
        'notes',
    ];

    /**
     * Optional: Constants for priority values
     */
    public const PRIORITY_VERY_HIGH = 'Very High';
    public const PRIORITY_HIGH = 'High';
    public const PRIORITY_MEDIUM = 'Medium';
    public const PRIORITY_LOW = 'Low';

    public static function getPriorityOptions(): array
    {
        return [
            self::PRIORITY_VERY_HIGH,
            self::PRIORITY_HIGH,
            self::PRIORITY_MEDIUM,
            self::PRIORITY_LOW,
        ];
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'facility_report_id', 'report_ID');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
