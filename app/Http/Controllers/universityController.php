<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class universityController extends Controller
{
    public function addUniversity(Request $request){

    	$isAlreadyRegisteredUniversity = DB::table('universities')->where('name', $request->university_name)->first();
    	if(isset($isAlreadyRegisteredUniversity)){
    		\Log::info('====duplicate university==========');
    		$university_id = 0;
    	} else {
    		$university_id = DB::table('universities')->insertGetId([
	    		'name' => $request->university_name,
	    		'country' => $request->university_country
    		]);
    		\Log::info('========university registered=========')    		;
    	}

    	/*$university_id = DB::table('universities')->insertGetId([
	    		'name' => $request->university_name,
	    		'country' => $request->university_country
    		]);*/
    	

    	//$request->university = getUniversityName($university_id);
    	\Log::info('here we call it');
    	\Log::info($university_id);
    	\Log::info('here it done');
    	//usersController(addUser($request));	
    	return view("index")->with($university_id);
    }

    public function getUniversityName($university_id){
    	return DB::table('universities')->where('id', $university_id)->select('name');
    }
}
