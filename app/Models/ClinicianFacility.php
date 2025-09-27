<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicianFacility extends Model
{
    protected $table = 'tbl_ClinicianFacility';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    
    protected $fillable = [
        'PhysicianId',
        'FacilityId',
        'DateAdded',
        'Deleted',
        'DeletedOn',
        'DeletedBy',
        'AddedBy',
        'ClinicianType'
    ];
    
    protected $casts = [
        'DateAdded' => 'datetime',
        'DeletedOn' => 'datetime',
        'Deleted' => 'boolean'
    ];
    
    // Relationships
    public function physician()
    {
        return $this->belongsTo(\App\User::class, 'PhysicianId', 'id');
    }
    
    public function facility()
    {
        return $this->belongsTo(\InvModels\SharedModels\Facility::class, 'FacilityId', 'Id');
    }
    
    public function addedBy()
    {
        return $this->belongsTo(\App\User::class, 'AddedBy', 'id');
    }
    
    public function deletedBy()
    {
        return $this->belongsTo(\App\User::class, 'DeletedBy', 'id');
    }
}
