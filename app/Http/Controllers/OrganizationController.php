<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    public static function addOrganization(Request $request){
    	\Log::info("==========here it starts==============");
    	$result = DB::table('organizations')->insertGetId([
    		'name' => $request->name,
    		'email' => $request->email,
    		'university_verified' => 0,
    		'location' => $request->location,
    		'university_name' => $request->university_name,
    		'password' => Hash::make($request->password)
    	]);

    	if(isset($result)){
    		\Log::info("organization added");
    		return view("organization");
    	} else{
    		return view("index");
    	}
    }
}
