<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
    		'password' => $staff->password
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
    		'password' => $request->password
    	]);

    	if(isset($result)){
    		\Log::info("student added");
    		return view("student");
    	} else{
    		return view("index");
    	}
    }

    public static function checkLogin(Request $request){
        $user = DB::table('users')
                ->where('nic', $request->nic)
                ->select('first_name', 'password', 'user_role', 'university_verified')
                ->first();

        if(! is_null($user)){
            if($request->password == $user->password){
                \Log::info('matches');
                if($user->user_role ==1){
                    return view('/staffHome')->with('user', $user);
                }
                else if($user->user_role ==3 ){
                    \Log::info('wrong  login');
                    return Redirect::to('/');
                }
            } else{
                \Log::info('wrong  password');
                return Redirect::to('/staff');
            }
        } else {
            \Log::info('wrong user');
            return Redirect::to('/');
        }
    }

    public static function checkStudentLogin(Request $request){
        $user = DB::table('users')
                ->where('nic', $request->nic)
                ->select('first_name', 'password', 'user_role', 'university_verified')
                ->first();

        if(! is_null($user)){
            if($request->password == $user->password){
                \Log::info('matches');
                if($user->user_role ==3 ){
                    if($user->university_verified == 1){
                        \Log::info($user);
                        \Log::info('=======with user===');
                        return view('/studentHome');
                    }else{
                        return view('/studentHome');
                    }
                }
            } else{
                \Log::info('wrong  password');
                return Redirect::to('/staff');
            }
        } else {
            \Log::info('wrong user');
            return Redirect::to('/');
        }
    }    
}
