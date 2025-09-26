<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    
    /*bitwise operators*/
    
    const USER_MANAGEMENT = 1;
    const FACILITY_MANAGEMENT = 2;
    const STIPHDENS_ADJUSTMENTS = 4;
    const VISITS = 8;
    const ORDER_SUPPLIES = 16;
    const COMPENSATION = 32;
    const WOUNDTRACKER = 64;
    const PCC = 128;
    const PATIENT = 256;
    const REPORTS = 512;
    
    protected $primaryKey = 'Id';
    protected $table = 'tblRoles';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    public function users(){
        return $this->hasMany(User::class, 'roleid');
    }
//     public function formstatus()
//     {
//         return $this->belongsTo(FormStatus::class, 'StatusId');
//     }
//
//    public function formtypes()
//    {
//        return $this->belongsTo(FormTypes::class, 'FormTypeId');
//    }
//    
//    public function formusers()
//    {
//        return $this->belongsTo(User::class, 'SubmittedBy');
//    }
}
