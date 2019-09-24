<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;

class SocialAuthController extends Controller
{
    //Metodo Encargado de redireccion a Facebook
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }

    //Metodo encargado de obtener la informacion del usuario
    public function handleProviderCallback($provider){
        //Obtenemos datos de usuario
        $social_user = Socialite::driver($provider)->user();

        //Comprobar si el usuario existe
        if($user=User::where('email',$social_user->email)->first()){
            return $this->authAndRedirect($user); //Login y Redireccion
        }
        else{
            $user=User::create([
                'first_name'=>$social_user->name,
                'email'=>$social_user->email,
                'avatar'=>$social_user->avatar,
            ]);
            return $this->authAndRedirect($user);
        }
    }
public function authAndRedirect($user){
    Auth::login($user);

    return redirect()->to('/home#');
}
}
