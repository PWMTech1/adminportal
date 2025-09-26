<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of XCounts
 *
 * @author Administrator
 */

namespace App\Classes;

class XCounts
{

    public $TotalFacilities;
    public $TotalActiveFacilities;
    public $TotalVisits;
}


class BillingDetails{
    public $CPTCode;
    public $Units;
    public $DiagnosisCodes;
    public $Modifiers;
    public $MRNumber;
    public $VisitId;
}