<?php

namespace App\Http\Controllers;

use Socialite;

class UserLoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try{
            $user = Socialite::driver('facebook')->user();
            dd($user);
        }
        catch(\Exception $e){
            return ['state' => 0, 'message' => 'Ignore to login with Facebook'];
        }
    }
}