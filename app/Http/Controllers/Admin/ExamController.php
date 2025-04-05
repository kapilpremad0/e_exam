<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExamRequest;
use App\Http\Requests\Admin\UpdateExamRequest;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    function index(Request $request)
    {
        $query_search = $request->input('search');
        $change_status = $request->input('change_status');
        $change_trending = $request->input('change_trending');
        if ($change_trending) {
            $category_change = Exam::find($change_trending);
            if ($category_change->trending == 1) {
                $category_change->update(['trending' => 0]);
                return 'Trending change successful';
            } else {
                $category_change->update(['trending' => 1]);
                return 'Trending change successful';
            }
        }
        if ($change_status) {
            $category_change = Exam::find($change_status);
            if ($category_change->status == 1) {
                $category_change->update(['status' => 0]);
                return 'Status change successful';
            } else {
                $category_change->update(['status' => 1]);
                return 'Status change successful';
            }
        }


        $exams = Exam::when($query_search, function ($query) use ($query_search) {
            $query->where('name', 'like', '%' . $query_search . '%');
        })->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.exams.pagination', compact('exams'))->render();
        }

        return view('admin.exams.index', compact('exams'));
    }


    function create()
    {
        // $categories = Category::where('status', 1)->get();
        return view('admin.exams.create');
    }


    function store(StoreExamRequest $request)
    {

        $data = $request->validated();
        $data['status'] = $request->status ?? 0;
        $data['trending'] = $request->trending ?? 0;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // Unique filename

            $image->move(public_path('storage'), $filename); // Move the file to a public directory
            $data['image'] = $filename;
        }

        $Exam = Exam::create($data);

        session()->flash('success', 'Exam Create Successfully');
    }

    function edit($id)
    {
        $exam = Exam::find($id);
        return view('admin.exams.create', compact('exam'));
    }

    function update(UpdateExamRequest $request, $id)
    {
        $data = $request->validated();
        $data['status'] = $request->status ?? 0;
        $data['trending'] = $request->trending ?? 0;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // Unique filename

            $image->move(public_path('storage'), $filename); // Move the file to a public directory
            $data['image'] = $filename;
        }
        Exam::where('id', $id)->update($data);
        session()->flash('success', 'Exam Update Successfully');
    }


    function destroy($id)
    {
        Exam::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Exam Delete Successfully');
    }


    function show($id)
    {
        $exam = Exam::find($id);
        $subjects = $exam->subjects()->get();
        return view('admin.exams.show', compact('exam','subjects'));
    }

    function subjects($id)
    {
        $subject = Subject::with('exam')->find($id);
        $levels = Level::where(['exam_id' => $subject->exam_id , 'subject_id' => $subject->id])->latest()->get();
        return view('admin.exams.subjects', compact('subject','levels'));
    }


    function levels($id)
    {
        $level = Level::with('exam','subject')->find($id);
        // return $level;
        $questions = Question::where('level_id',$id)->get();
        return view('admin.exams.levels', compact('level','questions'));
    }


}
