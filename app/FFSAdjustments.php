<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FFSAdjustments extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblFFSAdjustments';
    public $timestamps = false;
    protected $fillable = [
         'Description','Active','Units','UnitAmount','CreatedOn','CreatedBy'
     ];
    
     
}
