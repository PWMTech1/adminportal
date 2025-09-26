<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormMileage extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFormMileage';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'formid','totalmiles', 'filename', 'extension','OtherExpenses'
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
}
