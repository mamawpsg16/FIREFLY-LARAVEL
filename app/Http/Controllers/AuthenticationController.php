<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\AccountRecoveryQuestion;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreRegisterRequest;

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
        // dd($request->all());
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
        // dump($email);
        $user_exists = User::where('email',$email)->exists();
        // dd($user_exists);
        $user = User::where('email',$email)->first();
        if($user){
            $question = AccountRecoveryQuestion::find($user['recovery_question_id'])['question'];
        }
        return response()->json([
            'is_user_exist' => $user_exists,
            'question' => $question ?? ''
            // 'is_correct_answer' => $is_correct_answer
         ]);
    }
    public function verifyAnswer(Request $request){
        $answer = User::select('recovery_question_answer')->where('email',$request->input('email'))->first();
       
       $verified = strtolower($answer['recovery_question_answer']) == strtolower($request->input('question_answer'));

       return response()->json([
        'is_correct_answer' => $verified
        // 'is_correct_answer' => $is_correct_answer
     ]);
    }

    public function resetPassword(ResetPasswordRequest $request){

        $user = User::where('email', $request->input('email'))->first();
        // dd($request->all());
        if (!$user) {
            // user not found, handle error
        }
    
        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);


        return redirect()->route('login.authenticate')->with('success', 'Your password has been successfully changed. Please log in.');
    }
}

