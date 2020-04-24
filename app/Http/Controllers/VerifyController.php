<?php

namespace App\Http\Controllers;


use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class VerifyController extends Controller
{
    public function VerifyEmail($token = null)
    {
    	if($token == null) {

    		session()->flash('message', 'Invalid Login attempt');

    		return redirect()->route('login');

    	}

       $user = User::where('email_verification_token',$token)->first();

       if($user == null ){

        return "User doesnt exist";

       }

       $user1 = User::where('email_verification_token',$token)->first()   ;
       
          $user1->email_verified=1;
       $user1->email_verified_at=Carbon::now();
       $user1->save();

    //    $user->update([
        
    //     'email_verified' => 1,
    //     'email_verified_at' => Carbon::now(),

    //    ]);

       dd($user1);
       
       	// session()->flash('message', 'Your account is activated, you can log in now');


    }


}
