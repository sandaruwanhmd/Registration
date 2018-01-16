<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Mail\OrganizationRegistrationMail;
use Illuminate\Support\Facades\Mail;

class OrganizationController extends Controller
{
    public static function addOrganization(Request $request){
    	$isAlreadyExists = DB::table('organizations')->where('email', $request->email)->orwhere('registration_number', $request->nic)->count();
    	if($isAlreadyExists){
    		return Redirect::to('/organization')->with(['error' => 'Email or Registration Number already exists.']);
    	}
    	$result = DB::table('organizations')->insertGetId([
    		'name' => $request->name,
    		'email' => $request->email,
    		'registration_number' => $request->nic,
    		'university_verified' => 0,
    		'location' => $request->location,
    		'university_name' => $request->university_name,
    		'password' => $request->password
    	]);

    	if(isset($result)){
    		\Log::info("organization added");
    		$details['name'] = $request->name;
            $details['university'] = $request->university_name;
            Mail::to($request->email)->queue(new OrganizationRegistrationMail($details));
    		return view("organization");
    	} else{
    		return Redirect::to('/organization')->with(['error' => 'Something went wrong!']);
    	}
    }

    public static function checkOrganizationLogin(Request $request){
    	$organization = DB::table('organizations')
                ->where('registration_number', $request->nic)
                ->select('name', 'password', 'university_verified')
                ->first();
       
        if(! is_null($organization)){
            if($request->password == $organization->password){
                \Log::info('matches');
                    if($organization->university_verified == 1){
                        \Log::info($organization);
                        \Log::info('=======with user===');
                        return Redirect::to('/organizationHome')->with(['organization', $organization,  'success' => 'Login succesfully!']);
                    }else{
                        return Redirect::to('/organization')->with(['error' => 'Your company account is still pending for university approval!']);
                    }
            } else{
                \Log::info('wrong  password');
                return Redirect::to('/organization')->with(['error' => 'Invalid Password!']);
            }
        } else {
            \Log::info('wrong user');
            return Redirect::to('/organization')->with(['error' => 'Invalid User!']);
        }
    }
}
