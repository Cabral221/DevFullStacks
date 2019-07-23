<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    public function login(Request $request)
    {
        // Validate the request data form
        $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required|min:8',
        ]);

        // Attempt to log user in
        // dd(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1],$request->remember));
        if (Auth::guard('admin')->attempt($this->credentials($request),$request->remember)) {
            // if successful, then redirect to their intented location
            return redirect()->intended(route('admin.dashboard'));
        }
        
        return $this->sendFailedLoginResponse($request);
        //if not successful, then redirect back whit input value
        // return redirect()->back()->withInput($request->only('email','remember'));
    }
    
    public function credentials($request){
        $admin = Admin::where('email',$request->email)->first();
        // dd($admin);
        if($admin){
            if($admin->status == 0){
                return ['email'=>'inactive','password'=>'Vous n\'êtes pas un administrateur actif, Veuillez nous contacter !']; 
            }else{
                return ['email'=>$request->email,'password'=>$request->password,'status'=>1]; 
            }
        }
        return ['email'=>$request->email,'password'=>$request->password]; 
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
    