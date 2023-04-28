<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\AccountRecoveryQuestion;

class AuthenticationController extends Controller
{

    public function register()
    {
        $questions = AccountRecoveryQuestion::latest()->get();
       return view('authentication.register',compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerStore(StoreRegisterRequest $request)
    {
        // dd($request->input('question_id'),$request->input('question_answer'));
        // dd($request->input('first_name'));
        // dd($request->input('email'));
        $user = User::create([
            'first_name'  => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name'   => $request->input('last_name'),
            'email'       => $request->input('email'),
            'password'    => bcrypt($request->input('password')),
            'recovery_question_id' => $request->input('question_id'),
            'recovery_question_answer' => $request->input('question_answer')
        ]);

        if(!auth()->check()){
            auth()->login($user);
        }

        return redirect('/')->withInput()->with('success', 'Your account has been created');
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

    public function forgotPassword(){
        return view('authentication.forgot-password');
    }

    public function checkEmailIfExists(Request $request,$email){
        // dd($request->all());
        $user_exists = User::where('email',$email)->exists();
        $user = User::where('email',$email)->first();
        if($user){
            $question = AccountRecoveryQuestion::find($user['recovery_question_id'])['question'];
        }
        // $validate = $request->validate(['password' => ['required','confirmed'], 'password_confirmation' => 'required']);
        $is_correct_answer = false;
        if($user_exists){
            $is_correct_answer  = ($user['recovery_question_answer']  == $request->input('question_answer'));
        }
        // if($user_exists && $is_correct_answer){
        //     $user->update([
                
        //     ]);
        // }
        return response()->json([
            'is_user_exist' => $user_exists,
            'question' => $question ?? '',
            'is_correct_answer' => $is_correct_answer
         ]);
    }
}
