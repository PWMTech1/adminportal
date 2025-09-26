<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        
        $jobs = DB::table("tbl_Job_Post")->orderBy("StateName")->orderBy("City")->get();
    	return view('welcome', compact('jobs'));
    }
}
