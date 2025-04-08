<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubmitResultRequest;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Order;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SubmitResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeComtroller extends Controller
{
    

    function home(){
        $exams = Exam::with('subjects')->get();
        $data  = [ 
            'exams' => $exams
        ];
        return response()->json($data);
    }

    function subjectDetail($id){
        $subject = Subject::with('exam')->find($id);
        $levels = Level::where('subject_id',$id)->get();

        foreach($levels as $level){
            $check_payment = Order::where('user_id',Auth::id())
                ->where('level_id',$level->id)
                ->where('status','completed')
                ->where('payment_status','paid')
                ->where('is_played',0)
                ->latest()
                ->first();
                
            if($check_payment){
                $level['is_paid'] = true;
            }else{
                $level['is_paid'] = false;
            }

            $check_played = SubmitResult::where('user_id',Auth::id())
                ->where('level_id',$level->id)
                ->first();
            if($check_played){
                $level['is_played'] = true;
            }else{
                $level['is_played'] = false;
            }

            $level['play_count'] =  SubmitResult::where('user_id',Auth::id())
            ->where('level_id',$level->id)
            ->count();
        }

        return response()->json([
            'subject' => $subject,
            'levels' => $levels,
        ]);
    }

    function levelDetail($id){
        $level = Level::with('exam','subject')->find($id);
        if($level){
            $questions = Question::where('level_id',$id)->inRandomOrder()->take($level->quaction)->get();
        }
        return response()->json([
            'level' => $level,
            'questions' => $questions,
        ]);
    }

    function submitResult(SubmitResultRequest $request){
        $level = Level::find($request->level_id);

        $check_payment = Order::where('user_id',Auth::id())
            ->where('level_id',$request->level_id)
            ->where('status','completed')
            ->where('payment_status','paid')
            ->where('is_played',0)
            ->first();
            
        if(!$check_payment){
            return response()->json([
                'message' => 'Please pay for the exam before submitting the result.',
            ], 403);
        }

        
        $questions = $request->questions;
        $correct_question = 0;
        foreach($questions as $question){
            $ques = Question::find($question['question_id']);
            if($ques->correct_answer == $question['answer']){
                $correct_question ++;
            }
        }
        $submit_result = SubmitResult::create([
            'user_id' => Auth::id(),
            'level_id' => $request->level_id,
            'total_question' => $level->quaction,
            'correct_answer' => $correct_question,
        ]);

        Order::where('id',$check_payment->id)->update(['is_played' => 1]);
        $submit_result['message'] = 'Submit Result Successfully';
        return response()->json($submit_result);
    }


    function results(){
        $results = SubmitResult::where('user_id',Auth::id())->with('level')->latest()->get();
        return response()->json($results);
    }


}
