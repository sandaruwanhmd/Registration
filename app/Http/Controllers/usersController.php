<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usersController extends Controller
{
    public functiton addUser(Request $request){
    	$result = DB::table('users')->insertGetId(
    		'nic' => $request->nic,
    		'first_name' => $request->first_name,
    		'email' => $request->email,
    		'user_role' => 1,
    		'university_name' => $request->university,
    		'password' => Hash::make($request->password)
    	);
    }
}
