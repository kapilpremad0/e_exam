<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubjectRequest;
use App\Http\Requests\Admin\UpdateSubjectRequest;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    function index(Request $request)
    {
        $query_search = $request->input('search');
        $change_status = $request->input('change_status');
        
        if ($change_status) {
            $category_change = Subject::find($change_status);
            if ($category_change->status == 1) {
                $category_change->update(['status' => 0]);
                return 'Status change successful';
            } else {
                $category_change->update(['status' => 1]);
                return 'Status change successful';
            }
        }


        $subjects = Subject::when($query_search, function ($query) use ($query_search) {
            $query->where('name', 'like', '%' . $query_search . '%');
        })->with('exam')->latest()->paginate(10);

        // return $subjects;

        if ($request->ajax()) {
            return view('admin.subjects.pagination', compact('subjects'))->render();
        }

        return view('admin.subjects.index', compact('subjects'));
    }


    function create()
    {
        // $categories = Category::where('status', 1)->get();
        $exams = Exam::active()->orderBy('name','asc')->get();
        return view('admin.subjects.create',compact('exams'));
    }


    function store(StoreSubjectRequest $request)
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

        $Subject = Subject::create($data);

        session()->flash('success', 'Subject Create Successfully');
    }

    function edit($id)
    {
        $subject = Subject::find($id);
        $exams = Exam::active()->orderBy('name','asc')->get();
        return view('admin.subjects.create', compact('subject','exams'));
    }

    function update(UpdateSubjectRequest $request, $id)
    {
        $data = $request->validated();
        $data['status'] = $request->status ?? 0;
        // $data['trending'] = $request->trending ?? 0;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // Unique filename

            $image->move(public_path('storage'), $filename); // Move the file to a public directory
            $data['image'] = $filename;
        }
        Subject::where('id', $id)->update($data);
        session()->flash('success', 'Subject Update Successfully');
    }


    function destroy($id)
    {
        Subject::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Subject Delete Successfully');
    }


    public function getSubjects(Request $request)
    {
        $subjects = Subject::where('exam_id', $request->exam_id)->get();

        return response()->json(['subjects' => $subjects]);
    }

    
}
