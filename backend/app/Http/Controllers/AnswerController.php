<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AnswerController extends Controller
{
    protected $fillable = [
        'body', 'question_id', 'user_id'
    ];

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'answers.*' => 'nullable|integer|min:0|max:5',
        ]);
        $answers = $validatedData['answers'];

        // Find the authenticated user
        $user = Auth::user();

        foreach ($answers as $key => $value) {
            if(isset($value)) {
                // Find the question that the answer belongs to
                $question = Question::findOrFail($key);

                $answer = new Answer;
                $answer->body = $value;
                // Associate the answer with the question and user
                $answer->question()->associate($question);
                $answer->user()->associate($user);
                $answer->save();
            }
        }

        return response()->json([
            'message' => 'Answers stored successfully.',
        ], 201);
    }

    public function index()
    {
        $answers = Answer::all();

        return response()->json(['answers' => $answers], 200);
    }

    public function average()
    {
        $answers = Answer::selectRaw('questions.title as title, answers.question_id as question_id, AVG(answers.body) as average_body')
            ->join('questions', 'questions.id', '=', 'answers.question_id')
            ->groupBy('answers.question_id')
            ->get();

        return response()->json(['answers' => $answers], 200);
    }

}
