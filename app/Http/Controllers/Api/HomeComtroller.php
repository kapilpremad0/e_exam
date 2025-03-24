<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

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
        return response()->json([
            'subject' => $subject,
            'levels' => $levels,
        ]);
    }


}
