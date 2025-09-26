<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblForms';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'formtypeid', 'statusid', 'submittedby','servicestart','serviceend'
     ];

     public function formstatus()
     {
         return $this->belongsTo(FormStatus::class, 'StatusId');
     }

    public function formtypes()
    {
        return $this->belongsTo(FormTypes::class, 'FormTypeId');
    }
    
    public function formusers()
    {
        return $this->belongsTo(User::class, 'SubmittedBy');
    }
    
    public function modifiedusers()
    {
        return $this->belongsTo(User::class, 'ModifiedBy');
    }
    
    public function formmileage(){
         return $this->hasMany(FormMileage::class, 'FormId');
     }
     
     public function formsupplies(){
         return $this->hasMany(FormOrderSupplies::class, 'FormId');
     }
     
     public function address(){
         return $this->hasOne(FormAddress::class,'FormId');
     }
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
     
     protected $casts = [
         'submittedon' => 'datetime',
         'servicestart' => 'datetime',
         'serviceend' => 'datetime'
     ];
}
