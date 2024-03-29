<?php

namespace App\Http\Controllers\admin;
use \Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\models\User;
use App\models\EnrollClass;
use App\models\TeacherClass;
use App\models\Surah;
use App\models\TasmiRecord;
use Illuminate\Support\Facades\DB;






class ManageUsersController extends Controller
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

        $userdata = User::where('name', 'LIKE', "%$query%")->paginate(10);







        return view('admin.users.index' , compact('userdata'));    
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
    public function show(string $id)
    {
        //
       try {
            $id = Crypt::decrypt($id);
            $userdata =  User::where('id', $id)->get();

            $studentclass = EnrollClass::where('EnrollStudentId',$id)->get();
    
            $teacherclass = TeacherClass::where('ClassMakerId',$id)->get();
    
    
    
                   return view('admin.users.viewUser' , compact('userdata','studentclass','teacherclass'));

        } catch (DecryptException $e) {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //


        $userdata = User::find($id);
     $existsTeach = $userdata->ClassMaker()->exists();
        $existsStu = $userdata->enroll()->exists();

 
        if($existsStu ){
            return redirect()->route('admin.users.index')->with('error', 'User Enrolled in Class, Remove it first.');

        }
        
  

        if($existsTeach){
            return redirect()->route('admin.users.index')->with('error', 'User Enrolled in Class, Remove it first.');

        }

        else{
             $userdata->delete();
        return redirect()->route('admin.users.index')->with('alert', 'User Removed.');

        }
  

    }

    public function showRecord($ClassId,$id,Request $request)
    {
        //
try {
    $ClassId = Crypt::decrypt($ClassId);
    $id = Crypt::decrypt($id);

       // $classdata = EnrollClass::where('EnrollStudentId',$id)->get();
       $lessondata =  Surah::all();
       $userdata = User::find($id);
       $tasmiRec = TasmiRecord::where('TasmiStudentId', $id)->where('TasmiClassId', $ClassId)->orderBy('created_at','desc')->paginate(4);
       $class = TeacherClass::find($ClassId);
       
       $year = TasmiRecord::whereNotNull('created_at')->distinct()->select([DB::raw('YEAR(created_at) as year')])->orderBy('year')->get();
       $month = TasmiRecord::whereNotNull('created_at')->distinct()->select([DB::raw('MONTH(created_at) as month')])->orderBy('month')->get();

       $yearselect = $request->input('select2');
       $monthselect = $request->input('select1');

       $tasmiRec = TasmiRecord::whereHas('student', function ($queryBuilder) use ($id) {
           $queryBuilder->where('TasmiStudentId', $id);
       })->where('TasmiClassId',$ClassId)
           ->when($yearselect, function ($query) use ($yearselect) {
               $query->whereYear('created_at', $yearselect);
           })
           ->when($monthselect, function ($query) use ($monthselect) {
               $query->whereMonth('created_at', $monthselect);
           })->orderBy('created_at', 'desc')->paginate(10);

       
           $chartData = TasmiRecord::whereHas('student', function ($queryBuilder) use ($id) {
               $queryBuilder->where('TasmiStudentId', $id);
           })->where('TasmiClassId',$ClassId)
               ->when($yearselect, function ($query) use ($yearselect) {
                   $query->whereYear('created_at', $yearselect);
               })
               ->when($monthselect, function ($query) use ($monthselect) {
                   $query->whereMonth('created_at', $monthselect);
               })->orderBy('created_at', 'asc')->select(['TasmiSurahPage', 'created_at','TasmiSurahJuz'])
               ->get();

               $chartDataArray = $chartData->map(function ($record) {
                   return [
                       'TasmiSurahPage' => $record->TasmiSurahPage,
                       'created_at' => $record->created_at->toDateString(), // Adjust the date format as needed
                       'TasmiSurahJuz' => $record->TasmiSurahJuz,
                   ];
               })->toArray();




       return view('admin.users.viewRecord' ,compact('chartDataArray','lessondata','ClassId','id','userdata','tasmiRec','class','month','year','monthselect','yearselect'));



} catch (DecryptException $e) {
    abort(404);
}
     
    }

    
    public function removeEnroll($ClassId,$id,Request $request)
    {
        //

    
        $studata = EnrollClass::where('EnrollClassId', $ClassId)
        ->where('EnrollStudentId', $id)
        ->first();

        $teachdata = TeacherClass::where('id', $ClassId)
        ->where('ClassMakerId', $id)
        ->first();


        if($studata){

            $studata->delete();
            return redirect()->route('admin.users.index')->with('alert', 'User removed from a class');

        }

        if($teachdata){


            $teachdata->delete();

            return redirect()->route('admin.users.index')->with('alert', 'Class deleted');

        }

     
        }
  




    }

