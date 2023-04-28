<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\AccountRecoveryQuestion;

class AccountRecoveryQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = AccountRecoveryQuestion::latest()->get();
        return view('account-recovery-question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account-recovery-question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => ['required','unique:account_recovery_questions,question']
        ]);

        
        AccountRecoveryQuestion::create([
            'question' => $request['question']
            // 'user_id' => auth()->id()
        ]);
        
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AccountRecoveryQuestion $question)
    {
     
        return view('account-recovery-question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountRecoveryQuestion $question)
    {
        return view('account-recovery-question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,AccountRecoveryQuestion $question)
    {
        $request->validate([
            'question' => ['required', Rule::unique('account_recovery_questions')->ignore($question['id'])]
        ]);

        
       $question->update([
            'question' => $request['question']
            // 'user_id' => auth()->id()
        ]);
        
        return redirect()->route('question.show', $question['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountRecoveryQuestion $question)
    {
        $question->delete();

        return redirect()->route('question.index');
    }
}
