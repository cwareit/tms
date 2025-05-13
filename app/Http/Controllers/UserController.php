<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Activity;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $activity = new Activity();
            $activity->user_id = Auth::user()->id;
            $activity->activity = auth()->user()->name . ' ले लगइन गर्नुभयो ।';
            $activity->save();

            return redirect()->route('dashboard');
        }

        return back()->with('fail', 'ईमेल वा पासवर्ड मिलेन ।');
    }

    public function register()
    {
        return view('user.register');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'registration_key' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_again' => 'required|same:password',
        ]);
        if ($request->registration_key != config('app.registration_key')) {
            return back()->with('fail', 'रजिष्ट्रेशन की गलत छ ।');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = 'office';
        $user->password = Hash::make($request->password);
        $user->save();

        $activity = new Activity();
        $activity->user_id = 0;
        $activity->activity = $request->name . ' ले यस प्रणालीमा रजिष्टर गर्नुभयो ।';
        $activity->save();

        return redirect()->route('login')->with('pass', 'रजिष्ट्रेशन सफल भयो, अब लगइन गर्नुहोस् ।');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }




}
