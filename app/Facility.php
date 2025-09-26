<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFacility';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'name', 'address1', 'city', 'state','zipcode5','StatusId'
     ];

    public function facilitystatus(){
        return $this->hasMany(FacilityStatusTypes::class, 'Id');
    }
}
