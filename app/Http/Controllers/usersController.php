<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\UniversityRegistrationMail;

class usersController extends Controller
{
    public static function addUser($staff, $university_name){
        $isAlreadyExists = DB::table('users')->where('email', $staff->email)->orwhere('nic', $staff->nic)->count();

        if($isAlreadyExists){
            $id = 0;
            return $id;
        }
    	$id = DB::table('users')->insertGetId([
    		'nic' => $staff->nic,
    		'first_name' => $staff->name,
    		'email' => $staff->email,
    		'user_role' => 1,
    		'university_name' => $university_name,
    		'password' => $staff->password
    	]);
    	return $id;
    }

    public static function addStudent(Request $request){
        $isAlreadyExists = DB::table('users')->where('email', $request->email)->orwhere('nic', $request->nic)->count();
        if($isAlreadyExists){
            return Redirect::to('/student')->with(['error' => 'Student already exists!']);
        }
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
    		return Redirect::to('/student')->with(['error' => 'Something went wrong!']);
    	}
    }

    public static function checkLogin(Request $request){
        $data = ['nic' => $request->nic];
        \Mail::send('emails.UniversityAdminRegistration', $data, function ($message) use ($request) {
                            $message->from('noreply@yopmail.com', 'Darshana');
                            $message->to('ab@yopmail.com', $request->nic);
                            $message->subject('Welcome to Registration Team');
                        });
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
                    return Redirect::to('/staff')->with(['error' => 'Please use student login to sign in!']);
                }
            } else{
                \Log::info('wrong  password');
                return Redirect::to('/staff')->with(['error' => 'Invalid password!']);
            }
        } else {
            \Log::info('wrong user');
            return Redirect::to('/staff')->with(['error' => 'Invalid user!']);
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
                        return view('/studentHome')->with('user', $user);
                    }else{
                        return Redirect::to('/student')->with(['error' => 'Your account is still pending for university approval!']);
                    }
                }
            } else{
                \Log::info('wrong  password');
                return Redirect::to('/student')->with(['error' => 'Invalid password!']);
            }
        } else {
            \Log::info('wrong user');
            return Redirect::to('/student')->with(['error' => 'Invalid user!']);
        }
    }    
}
