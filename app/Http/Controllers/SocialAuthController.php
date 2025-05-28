<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try{
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->getId())->first();

            if(!$user){
                $new_user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    // 'password' => bcrypt(str_random(16)), // Random password for social users
                ]);
                Auth::login($new_user);
                return redirect()->route('home')->with('success', 'Successfully registered and logged in with Google.');
            }else {
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Successfully logged in with Google.');
            }


        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['error' => 'Failed to authenticate with Google.']);
        }
        
        return $this->loginOrCreateUser($googleUser, 'google');
    }

    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function handleFacebookCallback()
    // {
    //     $facebookUser = Socialite::driver('facebook')->stateless()->user();
    //     return $this->loginOrCreateUser($facebookUser, 'facebook');
    // }

    // protected function loginOrCreateUser($socialUser, $provider)
    // {
    //     $user = User::updateOrCreate(
    //         ['email' => $socialUser->getEmail()],
    //         [
    //             'name' => $socialUser->getName(),
    //             'provider' => $provider,
    //             'provider_id' => $socialUser->getId(),
    //         ]
    //     );

    //     Auth::login($user);
    //     return redirect()->route('dashboard');
    // }
}