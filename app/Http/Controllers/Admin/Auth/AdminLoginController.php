<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
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
        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)) {
            // if successful, then redirect to their intented location
            return redirect()->intended(route('admin.dashboard'));
        }
        
        //if not successful, then redirect back whit input value
        return redirect()->back()->withInput($request->only('email','remember'));
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
    