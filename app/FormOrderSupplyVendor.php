<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormOrderSupplyVendor extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFormOrderSupplyVendor';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    
     public function Supplyvendors(){
         return $this->belongsTo(FormOrderSupplyTypes::class, 'VendorId');
     }
}
