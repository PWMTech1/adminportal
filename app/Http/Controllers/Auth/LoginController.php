<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    
    public function showLogin() {
        return view("auth.login");
    }
    
    public function login(\Illuminate\Http\Request $request)
    {
        $credentials  = array('email' => $request->email, 'password' => $request->password);
        
        if (auth()->attempt($credentials, $request->has('remember'))){
            $id = \Illuminate\Support\Facades\Auth::user()->id;
            $user = \App\User::findOrFail($id);
            
            if($user->IsTempPassword == 1){
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'redirect' => url('password/expired')
                    ]);
                }
                return redirect()->intended('password/expired');
            }
            else{
                $user->lastlogindate = \Illuminate\Support\Carbon::now();
                $user->Save();
                
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'redirect' => url($this->redirectPath())
                    ]);
                }
                return redirect()->intended($this->redirectPath());
            }
        }
        
        // Login failed
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
        
        return redirect('login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Incorrect email address or password',
            ]);
    }
    public function authenticate(){
        
        if(\Illuminate\Support\Facades\Auth::attempt(['email' => $email, 'password' => $password])){
            $id = \Illuminate\Support\Facades\Auth::user()->id;
            $user = \App\User::findOrFail($id);
            if($user->istemppassword){
                return redirect('profile');
            }
        }
        else{
            return \Illuminate\Support\Facades\Redirect::to('/login');
        }
    }
}
