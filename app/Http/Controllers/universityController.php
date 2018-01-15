<?php

namespace App\Http\Controllers;

use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UniversityRegistrationMail;
use Illuminate\Support\Facades\Redirect;

use Mail;

class universityController extends Controller
{

	protected $usersController ='App\Http\Controllers\usersController';

    public function addUniversity(Request $request){

    	$isAlreadyRegisteredUniversity = DB::table('universities')->where('name', $request->university_name)->first();
        $isAlreadyRegisteredAdmin = DB::table('users')->where('email', $request->email)->orwhere('nic', $request->email)->first();
    	if((! empty($isAlreadyRegisteredUniversity)) || (! empty($isAlreadyRegisteredAdmin))){
    		\Log::info('====duplicate university==========');
    		return Redirect::to('/');
    	} else {
    		$university_id = DB::table('universities')->insertGetId([
	    		'name' => $request->university_name,
	    		'country' => $request->university_country
    		]);
    		\Log::info('========university registered=========');

    		//$university_name = $this->getUniversityName($university_id);

    		$user_id = $this->addStaff($request);

    		if(isset($user_id)){
    			//Mail::to($request->email)->queue(new UniversityRegistrationMail($request));
    			/*Maill::send('emails.universityAdminRegistration', ['name' => 'Registration'], function($message)
    			{
    				$message->to($request->email, 'Testing')->from('noreply@registration.com')->subject('Welcome')
    			})*/
                return Redirect::to('staff');
    		} else {
    			return Redirect::to('staff');
    		}    		
    	}
	}

    public function addStaff(Request $request){
    	$userId = DB::table('users')->insertGetId([
    		'nic' => $request->nic,
    		'first_name' => $request->name,
    		'email' => $request->email,
    		'user_role' => 1,
    		'university_name' => $request->university_name,
    		'password' => $request->password
    	]);
    	return $userId;
    }

	public function getAllUniversities(){
		\Log::info('here function was called');
		$items = DB::table('universities')->select('name')->get();
		return view('student', compact($items));
	}    

}
