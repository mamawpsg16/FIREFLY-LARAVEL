<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRegisterRequest;

class AuthenticationController extends Controller
{
    public function register()
    {
       return view('authentication.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerStore(StoreRegisterRequest $request)
    {
        // dd($request->input('first_name'));
        // dd($request->input('email'));
        $user = User::create([
            'first_name'  => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name'   => $request->input('last_name'),
            'email'       => $request->input('email'),
            'password'    => bcrypt($request->input('password'))
        ]);

        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created');
    }

    public function login()
    {
       return view('authentication.login');
    }

    

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/post');
        }
        // dd('PASOK');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login.create');
    }
}
