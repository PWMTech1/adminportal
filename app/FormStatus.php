<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormStatus extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFormStatus';
    public $timestamps = false;
    
    protected $fillable = [
         'Description'
     ];
    
    public function forms()
    {
        return $this->hasMany(Forms::class,'StatusId');
    }
}
