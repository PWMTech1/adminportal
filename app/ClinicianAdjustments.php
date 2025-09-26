<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicianAdjustments extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'tblClinicianAdjustments';
    public $timestamps = false;
    protected $fillable = [
        'UserId', 'AdjustmentId', 'CreatedOn', 'FormId', 'Units', 'Amount', 'ServiceFrom', 'ServiceEnd'
    ];
}
