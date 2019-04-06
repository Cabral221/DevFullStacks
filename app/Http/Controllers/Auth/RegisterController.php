<?php

namespace App\Http\Controllers\Auth;

use Flashy;
use App\Notifications\RegisterUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        // $this->guard()->login($user);

        $user->notify(new RegisterUser());

        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
        // Flashy::message("Votre compte a bien été crée, vous devez le confirmer avec l'email que vous allez recevoir");
        return redirect('/login')->with('success',"Votre compte a bien été crée, vous devez le confirmer avec l'email que vous allez recevoir");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => str_replace('/', '',bcrypt(str_random(16)))
        ]);
    }

    public function confirm($id, $token){
        $user = User::where('id',$id)->where('confirmation_token',$token)->first();
        if($user){
            $user->update(['confirmation_token' => null]);
            $this->guard()->login($user);
            return redirect($this->redirectPath())->with('success', "Votre compte a bien été confirmé");
        }else{
            return redirect('/login')->with('error',"Ce lien ne semble plus valide !");
        }
    }
}
