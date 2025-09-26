<?php

namespace App\Http\Controllers\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ExpiredPasswordController extends Controller
{

    public function expired()
    {
        return view('auth.passwords.expired');
    }
    
    public function postExpired(\App\Http\Requests\PasswordExpiredRequest $request)
    {
        // Checking current password
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $request->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }
        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->password_changed_at = Carbon::now();
        $user->IsTempPassword = 0;
        $user->save();
        //dd(Carbon::now()->toDateTimeString());
//        $request->user()->update([
//            'password' => bcrypt($request->password),
//            'password_changed_at' => Carbon::now(),
//            'IsTempPassword' => 0
//        ]);
        return redirect()->intended('home');
    }
}
