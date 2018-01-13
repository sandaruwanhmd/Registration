<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class usersController extends Controller
{
    public static function addUser($staff, $university_name){
    	\Log::info("==========================");
    	\Log::info($staff);
    	\Log::info("==========================");
    	$id = DB::table('users')->insertGetId([
    		'nic' => $staff->nic,
    		'first_name' => $staff->name,
    		'email' => $staff->email,
    		'user_role' => 1,
    		'university_name' => $university_name,
    		'password' => Hash::make($staff->password)
    	]);
    	\Log::info("==============user also added============");

    	\Log::info($id);
    	return $id;
    }

    public static function addStudent(Request $request){
    	$result = DB::table('users')->insertGetId([
    		'nic' => $request->nic,
    		'first_name' => $request->name,
    		'email' => $request->email,
    		'user_role' => 3,
    		'university_verified' => 0,
    		'university_name' => $request->university_name,
    		'password' => Hash::make($request->password)
    	]);

    	if(isset($result)){
    		\Log::info("student added");
    		return view("student");
    	} else{
    		return view("index");
    	}
    }

    public static function checkLogin(Request $request){
        \Log::info('functioni called');
        $user = DB::table('users')
                ->where('nic', $request->nic)
                ->get();

        \Log::info($user);        

        if(isset($user)){
            if(Hash::check($user->password, $user->password)){
                \Log::info('matches');
                return view('staffHome')->with($user);
            } else{
                \Log::info('wrong  password');
                return view("student");
            }
        } else {
            \Log::info('wrong user');
            return view("index");
        }        
    }    
}
