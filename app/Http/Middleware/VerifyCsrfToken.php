<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/pcc/patientdetails', '/pcc/pcclinkfacility', '/pcc/savelinkfacility', '/pcc/enableorg', '/pcc/saveorg', '/pcc/pcclinknotetype', '/pcc/savelinknotetype',
        '/pcc/movepatient/*', '/pcc/facilitydetails/*', '/pcc/pcclinkcategory', '/pcc/savelinkcategory', '/pcc/redownloadcategories/*', '/UpdateVisitComplete', '/uploadfacesheet',
        '/createorder', '/addeditcodes', '/addcptcodes' , '/sendemails', '/Tracker/UpdatedFacesheet', '/savereviewedvisits'
    ];
}