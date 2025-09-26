<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacilityStatusTypes extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFacilityStatusTypes';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'name', 'address1', 'city', 'state','zipcode5'
     ];

    public function facilitystatus(){
        return $this->hasMany(Facility::class, 'StatusId');
    }
}
