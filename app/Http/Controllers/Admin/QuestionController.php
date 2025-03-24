<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    function store(StoreQuestionRequest $request){
        $data = $request->validated();
        Question::create($data);
        session()->flash('success','Question Create Successfully');
    }

    function destroy($id)
    {
        Question::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Question Delete Successfully');
    }
}
