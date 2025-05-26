<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SampleTopsis extends Model
{
    use HasFactory;

    protected $table = 'sample_topsis';
    protected $primaryKey = 'id_sample';
    public $timestamps = false;

    protected $fillable = ['id_alternative', 'id_criteria', 'value'];

    // Belongs to an Alternative
    public function alternative()
    {
        return $this->belongsTo(AlternativeTopsis::class, 'id_alternative', 'id_alternative');
    }

    // Belongs to a Criteria
    public function criteria()
    {
        return $this->belongsTo(CriteriaTopsis::class, 'id_criteria', 'criteria_topsis_id');
    }
}
