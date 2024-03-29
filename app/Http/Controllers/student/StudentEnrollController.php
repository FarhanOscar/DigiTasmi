<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\TeacherClass;
use App\models\EnrollClass;
use App\models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Gate;



class StudentEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if(Gate::denies('manage-lessons'))
        {
            abort(403);
        };
        $query = $request->input('search');

        $classdata = TeacherClass::where('ClassName', 'LIKE', "%$query%")->get();


        return view('student.enroll.index' ,compact('classdata'));    
    }


    public function searchClass(Request $request)
    {
        //

     
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        //
        
       
    //     $enroll = new EnrollClass();

      
    //         // $enroll->EnrollClassId = ;
    //         $class->ClassDesc = $request->get('ClassDesc');
    //         $class->ClassMakerId = Auth::id();
    //         $class->save();



        
        

    //     return redirect()->route('teacher.classes.index')->with('success', 'Class successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

     

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

                  

        $enroll = new EnrollClass();

        $user = Auth::id(); 

 
        $query = $request->input('search');

        $classdata = TeacherClass::where('ClassName', 'LIKE', "%$query%")->get();

      
        $existingRow = EnrollClass::where('EnrollClassId', $id)
        ->where('EnrollStudentId', $user)
        ->exists();


        if($existingRow){

            return redirect()->route('student.enroll.index')->with('alert', 'Class already enrolled');



        } else{

            $enroll->EnrollClassId = $id;
            $enroll->EnrollStudentId = $user;
            $enroll->EnrollStatus = 1;
            $enroll->save();
        }

        return redirect()->route('student.enroll.index')->with('success', 'Class successfully enrolled');    

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ClassId,$id)
    {
        //
        
        $class = EnrollClass::where('EnrollClassId', $ClassId)->where('EnrollStudentId', $id)->first();
        // $class->EnrollStatus = 0;
        // $class->save();

    
        // return redirect()->route('student.classes.index')->with('alert', 'Class unenrolled');    


          if($class->EnrollStatus == 1){

                    $class->EnrollStatus = 0;
                    $class->save();


            return redirect()->route('student.classes.index')->with('alert', 'Class unenrolled');



        } else{

            $class->EnrollStatus = 1;
            $class->save();

              return redirect()->route('student.classes.index')->with('success', 'Class successfully enrolled');    

        }


        //
    
        
    }

    



}