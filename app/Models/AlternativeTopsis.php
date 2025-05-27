<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlternativeTopsis extends Model
{
    use HasFactory;

    protected $table = 'alternative_topsis';
    protected $primaryKey = 'id_alternative';
    public $timestamps = false;

    protected $fillable = ['alternative', 'report_id']; // Include report_id if needed

    // One Alternative belongs to a Report
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    // One Alternative has many SampleTopsis entries
    public function samples()
    {
        return $this->hasMany(SampleTopsis::class, 'id_alternative', 'id_alternative');
    }
}
