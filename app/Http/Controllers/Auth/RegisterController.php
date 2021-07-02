<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Funder;
use App\Models\PublicUser;
use App\Models\ServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    // use RegistersUsers;

    public $loginAfterSignup =true;
    public function registerPublic(Request $request){

        $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email',
            'password' =>'required|string|min:6|max:20',
            'password_confirmation' => 'required|string|min:6|max:20'
        ]);

        if(request('password') != request('password_confirmation'))
        {
            return response()->json(['error' => 'Passwords don\'t match'],401);
        }

        $input = $request->all();

        $user =User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'role' => '0',
            'password' => bcrypt($input['password'])
        ]); 
        
        $public =PublicUser::create([
            'user_id' => $user->id,
            'description' => request('description'),
        ]); 
        
        $success['name'] = $user->username;

        if($this->loginAfterSignup){
            return app('App\Http\Controllers\Auth\LoginController')->login($request);
        }

        
        return response()->json(['success' =>$success]);
    }

    public function registerServiceProvider(Request $request){

        $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email',
            'password' =>'required|string|min:6|max:20',
            'password_confirmation' => 'required|string|min:6|max:20'
        ]);

        if(request('password') != request('password_confirmation'))
        {
            return response()->json(['error' => 'Passwords don\'t match'],401);
        }


        $input = $request->all();

        $user =User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'role' => '1',
            'password' => bcrypt($input['password'])
        ]); 
        
        $public =ServiceProvider::create([
            'user_id' => $user->id,
            'company_name' => request('company_name'),
            'description' => request('description'),
        ]); 
        
        $success['name'] = $user->username;

        if($this->loginAfterSignup){
            return app('App\Http\Controllers\Auth\LoginController')->login($request);
        }

        
        return response()->json(['success' =>$success]);
    }


    public function registerFunder(Request $request){

        $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email',
            'password' =>'required|string|min:6|max:20',
            'password_confirmation' => 'required|string|min:6|max:20'
        ]);

        if(request('password') != request('password_confirmation'))
        {
            return response()->json(['error' => 'Passwords don\'t match'],401);
        }


        $input = $request->all();

        $user =User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'role' => '2',
            'password' => bcrypt($input['password'])
        ]); 
        
        $public =Funder::create([
            'user_id' => $user->id,
            'company_name' => request('company_name'),
            'description' => request('description'),
        ]); 
        
        $success['name'] = $user->username;

        if($this->loginAfterSignup){
            return app('App\Http\Controllers\Auth\LoginController')->login($request);
        }

        
        return response()->json(['success' =>$success]);
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
