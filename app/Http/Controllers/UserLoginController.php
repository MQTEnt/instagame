<?php

namespace App\Http\Controllers;

use Socialite;
use JWTAuth;
use JWTException;
use App\User;
use Carbon;
use Session;
use URL;

class UserLoginController extends Controller
{
    public function login(){
        $back_url = URL::previous();
        if(!is_null(Session::get('user-token'))){
            return redirect($back_url);
        }
        return view('auth.login', ['back_url' => $back_url]);
    }
    public function logout(){
        if(!is_null(Session::get('user-token'))){
            $token = Session::get('user-token')[0];
            Session::forget('user-token');
            //What if token expired? (Fix...)
            JWTAuth::invalidate($token);
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try{
            $user_fb = Socialite::driver('facebook')->user();
            //Check user if existed in Database
            $user = User::where('fb_id', '=', $user_fb->id)->first();

            if(is_null($user)){
                $user = new User();
                $user->points = 0;
                $user->fb_id = $user_fb->id;
                $user->save();
            }

            try {
                $exp = Carbon\Carbon::now()->addHours(1)->timestamp; //Set expiry (1 hour)

                // Create Token with current user login
                if (! $token = JWTAuth::fromUser($user, ['exp' => $exp])) {
                    //return response()->json(['state' => 0, 'error' => 'Could not get user'], 401);
                    return view('auth.login-fb', ['state' => 0, 'error' => 'Could not get user']);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                //return response()->json(['state' => 0, 'error' => 'Could not get token'], 500);
                return view('auth.login-fb', ['state' => 0, 'error' => 'Could not get token']);
            }
            // all good so return the token
            Session::push('user-token', $token);
            //return response()->json(['state' => 1, 'data'=> [ 'token' => $token ]]);
            return view('auth.login-fb', ['state' => 1, 'token' => $token]);
        }
        catch(\Exception $e){
            return ['state' => 0, 'message' => 'Ignore to login with Facebook'];
        }
    }
}