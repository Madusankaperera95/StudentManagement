<?php

namespace App\Http\Controllers;



use App\Models\Subject;
use App\Models\User;
use Yajra\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    //

    public function index(){
        if(Auth::check()){

            return view('student');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function viewPerformancePage(){
        if(Auth::check()){
           $students=User::where('user_type_id',2)->doesntHave('subjects')->get();
           $subjects=Subject::all();
            return view('studentPerformance',compact('students', 'subjects'));
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function UpdateMarks(Request $request)
    {
        $student=User::where('id',$request->studentid)->first();
        $student->subjects()->detach();
        $subjects = $request->input('subjects', []);
        $marks = $request->input('marks', []);
        for ($subject=0; $subject<count($subjects); $subject++) {
            if ($subjects[$subject] != '') {
                $student->subjects()->attach(Subject::where('name',$subjects[$subject])->pluck('id')->first(), ['marks' => $marks[$subject]]);
            }
        }

        return response()->json(['success'=>'Added Marks']);
    }

    public function removeStudent($id){
        $student=User::where('id',$id)->first();
        if ($student) {
            $student->subjects()->detach();
            $student->delete();
            return response()->json(['message' => "Student Record Deleted"]);
        } else {
            return response()->json(['message' => "Student not found"], 404);
        }
    }

    public function getstudents(Request $request)
    {
        if($request->ajax()){
           $customers=User::where('user_type_id',2)->get();

           return DataTables\Facades\DataTables::of($customers)
                  ->addIndexColumn()
                  ->addColumn('action',function ($row){
                      $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-url="' . route('student.edit', ['id' => $row->id]) . '"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStudent">Edit</a>';

                      $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteStudent">Delete</a>';

                      return $btn;
                  })->rawColumns(['action'])
                   ->make(true);
        }
    }


    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        User::where('id',$id)->update(['name'=>$request->name,'email' => $request->email]);
        return response()->json(['message' => "Student Record Updated"]);
    }

    public function edit($id){
        $user=User::find($id);
        return $user;
    }

    public function viewPerformanceofStudent($id){
        $student=User::where('id',$id)->with('subjects')->first();
        return $student;
    }

    public function removemarks($id){
        $student=User::where('id',$id)->first();
        if ($student) {
            $student->subjects()->detach();
            return response()->json(['message' => "Student Marks Deleted"]);
        } else {
            return response()->json(['message' => "Student not found"], 404);
        }
    }

    public function addmarks(Request $request){
        $request->validate([
            'studentid' => 'required',
            'subjects' => 'required|array',
            'subjects.*' => 'required|string',
            'marks' => 'required|array|min:1',
            'marks.*' => 'required|numeric|min:0|max:100',
            'subjects'=>'min:'.count($request->input('marks', [])),

        ]);


        $student=User::where('id',$request->studentid)->first();
        $subjects = $request->input('subjects', []);
        $marks = $request->input('marks', []);
        for ($subject=0; $subject<count($subjects); $subject++) {
            if ($subjects[$subject] != '') {
                $student->subjects()->attach(Subject::where('name',$subjects[$subject])->pluck('id')->first(), ['marks' => $marks[$subject]]);
            }
        }

        return response()->json(['success'=>'Added Marks']);





    }

    public function getallmarks(){
        $studentwithmarks=User::where('user_type_id',2)->has('subjects')->with('subjects')->get();
        return DataTables\Facades\DataTables::of($studentwithmarks)
            ->addIndexColumn()
            ->addColumn('action',function ($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMarks">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteMarks">Delete</a>';
                return $btn;
            })->rawColumns(['action'])
            ->make(true);

    }
}
