<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormTypes extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFormTypes';
    public $timestamps = false;
    protected $fillable = [
         'Description'
     ];
    
    public function forms()
    {
        return $this->hasMany(Forms::class, 'FormTypeId');
    }
     
}
