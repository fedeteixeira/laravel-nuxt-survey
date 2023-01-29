<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, $question_id)
    {
        // Validate the request data
        $request->validate([
            'body' => 'required|integer|min:0|max:5',
        ]);

        // Find the question that the answer belongs to
        $question = Question::findOrFail($question_id);

        // Find the authenticated user
        $user = auth()->user();

        // Create a new answer instance
        $answer = new Answer([
            'body' => $request->body,
        ]);

        // Associate the answer with the question and user
        $answer->question()->associate($question);
        $answer->user()->associate($user);

        // Save the answer to the database
        $answer->save();

        return response()->json([
            'message' => 'Answer created successfully.',
            'answer' => $answer,
        ], 201);
    }

    public function index()
    {
        $answers = Answer::all();

        return response()->json(['answers' => $answers], 200);
    }

    public function average()
    {
        $answers = Answer::selectRaw('question_id, AVG(body) as average_body')
            ->groupBy('question_id')
            ->get();

        return response()->json(['answers' => $answers], 200);
    }

}
