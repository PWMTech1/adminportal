<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormAddress extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFormsAddress';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    protected $fillable = [
         'FormId'
     ];

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
     public function forms(){
         return $this->belongsTo(Forms::class, 'FormId');
     }
     
//     
//     public function vendors(){
//         return $this->belongsTo(FormOrderSupplyVendor::class, 'VendorId');
//     }
}
