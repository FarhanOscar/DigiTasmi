<?php

namespace App\Http\Controllers\teacher;
use \Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\TeacherClass;
use App\models\EnrollClass;
use App\models\TasmiRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

use App\models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Gate;



class TeacherClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if(Gate::denies('manage-courses'))
        {
            abort(403);
        };
        $query = $request->input('search');




        $user = Auth::id(); 
        $userdata= User::where('id',$user)->get();
        $classdata = TeacherClass::where('ClassMakerId',$user)->get();

        $classdata = TeacherClass::where('ClassMakerId', $user)
        ->where('ClassName', 'LIKE', "%$query%")->get();



        return view('teacher.classes.index' ,compact('userdata','classdata',));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('teacher.classes.addClass');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
       
        $class = new TeacherClass();

      
            $class->ClassName = $request->get('ClassName');
            $class->ClassDesc = $request->get('ClassDesc');
            $class->ClassMakerId = Auth::id();
            $class->save();



        
        

        return redirect()->route('teacher.classes.index')->with('success', 'Class successfully created.');
    }

    /**
     * Display record class.
     */
    //     $users = User::get();

    //     $data = [
    //         'title' => 'DigiTasmi Tasmi System',
    //         'date' => date('m/d/Y'),
    //         'users' => $users
    //     ];

    //     $pdf = PDF::loadView('teacher.classes.pdfTemplate', $data);
    //     return $pdf->download('users-lists.pdf'); 
    
    public function show(string $id, Request $request)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            // If decryption fails, return a 404 response
            abort(404);
        }

        try {
            $data = $this->getCommonData($id, $request);
            return view('teacher.classes.classRecord', $data);
        } catch (ModelNotFoundException $e) {
            // If model is not found, return a 404 response
            abort(404);
        }
        
        // $id = Crypt::decrypt($id);    

        // $data = $this->getCommonData($id, $request);
        // return view('teacher.classes.classRecord', $data);

 
        

        // return view('teacher.classes.pdfTemplate', $data);


    }

    public function pdf(String $id, Request $request)
     {    
        $data = $this->getCommonData($id, $request);
        $action = $request->input('action');

        if ($action === 'filter') {

            try {
                $id = Crypt::decrypt($id);
            } catch (DecryptException $e) {
                // If decryption fails, return a 404 response
                abort(404);
            }
    
            try {
                $data = $this->getCommonData($id, $request);
                return view('teacher.classes.classRecord', $data);
            } catch (ModelNotFoundException $e) {
                // If model is not found, return a 404 response
                abort(404);
            }
            


        } else if ($action === 'pdf') {
            // Preview model
            $id = Crypt::decrypt($id);

            $data = $this->getCommonData($id, $request);
            $image = base64_encode(file_get_contents(public_path('storage\digitasmi-logo.png')));
            $pdfData = array_merge($data, ['image' => $image]);

        // return view('teacher.classes.pdftemplate',$pdfData);
                $pdf = PDF::loadView('teacher.classes.pdfTemplate', $pdfData);
        return $pdf->download('Class_Report_DigiTasmi.pdf'); 
           
    }
  
        

    }


    private function getCommonData(string $id, Request $request = null)
    {
        $user = Auth::id();
        $className = TeacherClass::where('id', $id)->first();
        $action = $request->input('action');

        $year = TasmiRecord::whereNotNull('created_at')->distinct()->select([DB::raw('YEAR(created_at) as year')])->orderBy('year')->get();
        $month = TasmiRecord::whereNotNull('created_at')->distinct()->select([DB::raw('MONTH(created_at) as month')])->orderBy('month')->get();

        $yearselect = $request->input('select2');
        $monthselect = $request->input('select1');

        
        $classdata = TasmiRecord::whereHas('student', function ($queryBuilder) use ($id) {
            $queryBuilder->where('TasmiClassId', $id);
        })
            ->when($yearselect, function ($query) use ($yearselect) {
                $query->whereYear('created_at', $yearselect);
            })
            ->when($monthselect, function ($query) use ($monthselect) {
                $query->whereMonth('created_at', $monthselect);
            })->orderBy('created_at', 'desc')->paginate(10);

            if ($action === 'pdf') {
                $classdata = TasmiRecord::whereHas('student', function ($queryBuilder) use ($id) {
                    $queryBuilder->where('TasmiClassId', $id);
                })
                    ->when($yearselect, function ($query) use ($yearselect) {
                        $query->whereYear('created_at', $yearselect);
                    })
                    ->when($monthselect, function ($query) use ($monthselect) {
                        $query->whereMonth('created_at', $monthselect);
                    })->orderBy('created_at', 'desc')->get();

                // Paginate only if 'generate_pdf' input is not present
            } 
            $monthselected = $request->monthSelect;


        return compact('classdata', 'className','yearselect','monthselect','year', 'month', 'id','user','action');
    }





   

    

    
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, )
    {
        //
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            // If decryption fails, return a 404 response
            abort(404);
        }

        try {
            $classdata = TeacherClass::where('id',$id)->get();
            $studentenroll = EnrollClass::where('EnrollClassId', $id)->get();

            return view('teacher.classes.manageClass',compact('classdata','studentenroll'));
        } catch (ModelNotFoundException $e) {
            // If model is not found, return a 404 response
            abort(404);
        }
        
        // $id = Crypt::decrypt($id);    

        // $classdata = TeacherClass::where('id',$id)->get();

        // $studentenroll = EnrollClass::where('EnrollClassId', $id)->get();

        

        // return view('teacher.classes.manageClass',compact('classdata','studentenroll'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

           
        $class = TeacherClass::find($id);


        if (!$class) {
            return abort(404); // Class not found
        }
   
            $class->ClassName = $request->get('ClassName');
            $class->ClassDesc = $request->get('ClassDesc');
            $class->save();


        
    

        return redirect()->route('teacher.classes.index')->with('success', 'Class successfully updated.');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

try {
    $id = Crypt::decrypt($id);
} catch (DecryptException $e) {
    $user = Auth::id();
        $class = TeacherClass::where('id', $id)->where('ClassMakerId', $user)->first();

        if($class){

            $existPart = $class->class()->exists();

            if ($existPart) {
                // Handle the case where there are participants.
                return redirect()->route('teacher.classes.index')->with('error', 'Cannot delete class with participants.');
            }

            $class->delete();

            return redirect()->route('teacher.classes.index')->with('alert', 'Class Deleted');

}

        

        }

        // else{
        // return redirect()->route('teacher.classes.index')->with('alert', 'Class Deleted');

        // }
    }

    



}