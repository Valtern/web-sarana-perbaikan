<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CriteriaTopsis extends Model
{
    use HasFactory;

    protected $table = 'criteria_topsis';
    protected $primaryKey = 'criteria_topsis_id';
    public $timestamps = false;

    protected $fillable = ['criteria_name', 'weight', 'type'];

    // One Criteria has many SampleTopsis entries
    public function samples()
    {
        return $this->hasMany(SampleTopsis::class, 'id_criteria', 'criteria_topsis_id');
    }
}
