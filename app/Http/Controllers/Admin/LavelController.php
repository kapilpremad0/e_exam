<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLevelRequest;
use App\Http\Requests\Admin\UpdateLevelRequest;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class LavelController extends Controller
{
    function index(Request $request)
    {
        $query_search = $request->input('search');
        $change_status = $request->input('change_status');
        
        if ($change_status) {
            $category_change = Level::find($change_status);
            if ($category_change->status == 1) {
                $category_change->update(['status' => 0]);
                return 'Status change successful';
            } else {
                $category_change->update(['status' => 1]);
                return 'Status change successful';
            }
        }


        $levels = Level::when($query_search, function ($query) use ($query_search) {
            $query->where('name', 'like', '%' . $query_search . '%');
        })->with('exam','subject')->latest()->paginate(10);

        // return $levels;

        if ($request->ajax()) {
            return view('admin.levels.pagination', compact('levels'))->render();
        }

        return view('admin.levels.index', compact('levels'));
    }


    function create()
    {
        // $categories = Category::where('status', 1)->get();
        $exams = Exam::active()->orderBy('name','asc')->get();
        return view('admin.levels.create',compact('exams'));
    }


    function store(StoreLevelRequest $request)
    {

        $data = $request->validated();
        $data['status'] = $request->status ?? 0;
        $Subject = Level::create($data);

        session()->flash('success', 'Subject Create Successfully');
    }


    function show($id){
        $level = Level::find($id);
        $questions = [];
        return view('admin.levels.show',);
    }

    function edit($id)
    {
        $level = Level::find($id);
        $exams = Exam::active()->orderBy('name','asc')->get();
        $subjects = Subject::where('exam_id',$level->exam_id)->get();
        // return $subjects;
        return view('admin.levels.create', compact('level','exams','subjects'));
    }

    function update(UpdateLevelRequest $request, $id)
    {
        $data = $request->validated();
        $data['status'] = $request->status ?? 0;
        Level::where('id', $id)->update($data);
        session()->flash('success', 'Subject Update Successfully');
    }


    function destroy($id)
    {
        Level::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Subject Delete Successfully');
    }
}
