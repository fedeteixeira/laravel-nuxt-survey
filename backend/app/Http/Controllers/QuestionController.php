<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return response()->json(['questions' => $questions], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $question = auth()->user()->questions()->create($validatedData);

        if ($question) {
            return response()->json(['message' => 'Question has been added'], 201);
        }

        return response()->json(['error' => 'Failed to add question'], 500);
    }
}
