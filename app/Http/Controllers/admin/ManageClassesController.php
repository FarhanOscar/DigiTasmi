<?php

namespace App\Http\Controllers\admin;
use \Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\models\TeacherClass;
use App\models\EnrollClass;
use App\models\TasmiRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class ManageClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if(Gate::denies('manage-users'))
        {
            abort(403);
        };

        $query = $request->input('search');

        $classdata = TeacherClass::where('ClassName', 'LIKE', "%$query%")->paginate(10);







        return view('admin.classes.index' , compact('classdata'));    
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ClassId, $ClassMakerId)
    {
        //
        try {
            $ClassId = Crypt::decrypt($ClassId);
            $ClassMakerId = Crypt::decrypt($ClassMakerId);

        } catch (DecryptException $e) {
            // If decryption fails, return a 404 response
            abort(404);
        }

        try {
            $studentenroll =  EnrollClass::where('EnrollClassId', $ClassId)
            ->whereHas('class', function ($query) use ($ClassMakerId) {
                $query->where('ClassMakerId', $ClassMakerId);
            })
            ->get();
    
            $classdata = TeacherClass::where('id', $ClassId)
            ->where('ClassMakerId', $ClassMakerId)
            ->get();
    
            return view('admin.classes.viewClass', compact('studentenroll','classdata'));
    
        } catch (ModelNotFoundException $e) {
            // If model is not found, return a 404 response
            abort(404);
        }


      


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
    public function update(Request $request, string $id)
    {
        //

              
        $class = TeacherClass::find($id);


        if (!$class) {
            return redirect()->route('admin.classes.index')->with('error', 'Class not found.');
        }
   
            $class->ClassName = $request->get('ClassName');
            $class->ClassDesc = $request->get('ClassDesc');
            $class->save();


        
    

        return redirect()->route('admin.classes.index')->with('success', 'Class successfully updated.');
    }


    public function destroy(string $ClassId, $StudentId)
    {
        //

        $enrollstudent = EnrollClass::where('id', $ClassId)
        ->where('EnrollStudentId', $StudentId)
        ->first();
    
            if ($enrollstudent) {


    $enrollstudent->delete();
            // Additional logic after successful deletion
            return redirect()->route('admin.classes.index')->with('alert', 'Participant Deleted');
              
            } 

            else {
                return redirect()->route('admin.classes.index')->with('error', 'Oops Something Happenning...');


            }
            
            
            
    


    }

    public function deleteClass(string $ClassId, $ClassMakerId)
    {
        //
        

        $class = TeacherClass::where('id', $ClassId)
    ->where('ClassMakerId', $ClassMakerId)
    ->first();

        if ($class) {

            $existPart = $class->class()->exists();

            if ($existPart) {
                // Handle the case where there are participants.
                return redirect()->route('admin.classes.index')->with('error', 'Cannot delete class with participants.');
            
            }
            
          
        } 
        $class->delete();
        // Additional logic after successful deletion
        return redirect()->route('admin.classes.index')->with('alert', 'Class Deleted');
        
        



    }

    public function record(string $ClassId, Request $request)
    {
        $data = $this->getCommonData($ClassId, $request);
        return view('admin.classes.classRecord', $data);

 
        

        // return view('teacher.classes.pdfTemplate', $data);


    }

    public function pdf(String $ClassId, Request $request)
     {    

        try {
            $ClassId = Crypt::decrypt($ClassId);
        } catch (DecryptException $e) {
            // If decryption fails, return a 404 response
            abort(404);
        }

        try {
            $ClassId = Crypt::decrypt($ClassId);
            $data = $this->getCommonData($ClassId, $request);
        $action = $request->input('action');

        if ($action === 'filter') {
            $ClassId = Crypt::decrypt($ClassId);
            $data = $this->getCommonData($ClassId, $request);
        return view('admin.classes.classRecord', $data);

        } else if ($action === 'pdf') {
            // Preview model
            $ClassId = Crypt::decrypt($ClassId);

            $data = $this->getCommonData($ClassId, $request);
            $image = base64_encode(file_get_contents(public_path('storage\digitasmi-logo.png')));
            $pdfData = array_merge($data, ['image' => $image]);

        // return view('teacher.classes.pdftemplate',$pdfData);
        //         $pdf = PDF::loadView('teacher.classes.pdfTemplate', $pdfData);
        // return $pdf->download('Class_Report_DigiTasmi.pdf'); 
           
    }



        } catch (ModelNotFoundException $e) {
            // If model is not found, return a 404 response
            abort(404);
        }
        
        // $data = $this->getCommonData($ClassId, $request);
        // $action = $request->input('action');

     
  
        

    }


    private function getCommonData(string $ClassId, Request $request = null)
    {

        try {
            $user = Auth::id();
            $ClassId = Crypt::decrypt($ClassId);
    
            $className = TeacherClass::where('id', $ClassId)->first();
            $action = $request->input('action');
    
            $year = TasmiRecord::whereNotNull('created_at')->distinct()->select([DB::raw('YEAR(created_at) as year')])->orderBy('year')->get();
            $month = TasmiRecord::whereNotNull('created_at')->distinct()->select([DB::raw('MONTH(created_at) as month')])->orderBy('month')->get();
    
            $yearselect = $request->input('select2');
            $monthselect = $request->input('select1');
    
            
            $classdata = TasmiRecord::whereHas('student', function ($queryBuilder) use ($ClassId) {
                $queryBuilder->where('TasmiClassId', $ClassId);
            })
                ->when($yearselect, function ($query) use ($yearselect) {
                    $query->whereYear('created_at', $yearselect);
                })
                ->when($monthselect, function ($query) use ($monthselect) {
                    $query->whereMonth('created_at', $monthselect);
                })->orderBy('created_at', 'desc')->paginate(10);       
                
             } catch (DecryptException $e) {
            // If decryption fails, return a 404 response
            abort(404);
        }

        try {



        return compact('classdata', 'className','yearselect','monthselect','year', 'month','user','action');

        
        } catch (ModelNotFoundException $e) {
            // If model is not found, return a 404 response
            abort(404);
        }
       

    }




    

    
}
