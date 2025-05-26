<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'building';

    // Primary key
    protected $primaryKey = 'building_ID';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // Key type
    protected $keyType = 'int';


    // Mass assignable attributes
    protected $fillable = [
        'building_ID', 
        'name',
        'location',
        'status',
    ];

     public $timestamps = false;

    // Relationships
    public function facilities()
    {
        return $this->hasMany(Facility::class, 'building_ID', 'building_ID');
    }
}
