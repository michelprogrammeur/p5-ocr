<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\RegisteredUser;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $user->notify(new RegisteredUser());
        return redirect('/login')->with('success', "Votre compte a bien été créé, vous devez le comfirmer avec l'email que vous allez recevoir");
    }


    public function confirm($id, $token) {
        $user = User::where('id', $id)->where('confirmation_token', $token)->first();

        if ($user) {
            $user->update(['confirmation_token' => null]);
            $this->guard()->login($user);

            return redirect($this->redirectPath())->with('success', "Votre à bien été confirmé.");
        } else {
            return redirect('/login')->with('error', "Ce lien ne semble plus valide.");
        }
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
            'pseudo' => 'required|string|regex:/^[a-zA-Z0-9_]{3,50}$/',
            'firstname' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/|confirmed',
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
        $user = User::create([
            'pseudo' => $data['pseudo'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email'  => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_token' => str_replace('/', '', bcrypt(str_random(20)))
        ]);
        $user->roles()->attach(Role::where('name', 'visiteur')->first());

        return $user;
    }
}
