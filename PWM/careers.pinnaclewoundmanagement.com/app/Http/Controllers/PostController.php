<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = DB::select("SELECT * FROM tbl_Job_Post WHERE Slug = '" . $slug . "';");
    	
    	if (!$post) {
    		return redirect('/');
    	}

    	return view('show', [
    		'job' => $post,
            'metaTitle' => 'Pinnacle Wound Management ' . $post[0]->Title . ' job',
    	]);
    }
}
