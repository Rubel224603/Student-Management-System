<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public $studentRepo;

    public function create(){
        return view('admin.student.create');
    }
    public function __construct(StudentRepositoryInterface $studentRepoObj)
    {
        $this->studentRepo = $studentRepoObj;
    }

    public function store(Request $request){
       $request->validate([
            'name'  => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|unique:students,email',
            'phone'=>'required|unique:students,phone',
            'date_of_birth'=>'required'
            ],

            ['name.required' => "Name  dao .",
              'name.regex'   => "shudhu okkhor dao .",
              'name.max'      => "250 er besi na",

                'email.required'=> "Email lagbe",
                'email.string'=> "sothik kore likhun",
                'email.unique'=> "eta to ase , notun kore dao",

                'phone.required'=>"Phone Number lagbei",
                'phone.unique'=>"age theke use hocce notun number add koro",

         ] );
        $this->studentRepo->store($request);
        //Student::addNewStudent($request);
        return back()->with("message","New student added successfully");
    }

    public function allStudent(Request $request){

        //$students = $this->studentRepo->all();
        $total = $this->studentRepo->totalStudent();

        if(isset($request->name)){
            $students = $this->studentRepo->search($request->name);
        }
//        if($request->filled('name')){
//            $students = $this->studentRepo->search($request->name);
//            //$students = Student::where('name','like', "%{$request->name}%")->orWhere('email','like' ,"%{$request->name}%")->paginate(5);
//        }
        else {
            $students = $this->studentRepo->all();
        }
         return view('admin.student.list',compact('students','total'));
    }

    public function edit($id){
        $student =$this->studentRepo->find($id);
       return view('admin.student.edit',compact('student'));
    }
    public function update($id,Request $request){
        $page = $request->input('page');
        //return $page;
        $this->studentRepo->update($id,$request);

        //Student::updateStudent($id,$request);
        return redirect('/student-list?page=' . $page)->with("update","post updated successfully");


    }

    public function delete($id){
       // Student::deleteStudent($id);
        $this->studentRepo->delete($id);
        return back()->with('message','Student deleted successfully');
    }


}
