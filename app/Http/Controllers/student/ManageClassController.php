<?php

namespace App\Http\Controllers\student;
use \Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\TeacherClass;
use App\models\EnrollClass;
use App\models\User;
use App\models\Surah;
use App\models\TasmiRecord;
use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Gate;



class ManageClassController extends Controller
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




        $user = Auth::id(); 
        $userdata= User::where('id',$user)->get();
        $classdata = EnrollClass::where('EnrollStudentId',$user)->get();




        return view('student.classes.index' ,compact('userdata','classdata'));    
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
    public function store(Request $request)
    {
        //
        
       
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //


    }

    public function view(string $id)
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

        return view('student.classes.viewClass',compact('classdata','studentenroll'));

        } catch (ModelNotFoundException $e) {
            // If model is not found, return a 404 response
            abort(404);
        }
      

        
        // $userdata = StudentEnroll::();





    }

    public function viewRecord($ClassId,$id,Request $request)
    {
        try {
            $ClassId = Crypt::decrypt($ClassId);
            $id = Crypt::decrypt($id);

        } catch (DecryptException $e) {
            // If decryption fails, return a 404 response
            abort(404);
        }

        try {
            $lessondata =  Surah::all()->sortBy('sequences');
            $user = User::find($id);
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
    
    
    
    
            return view('teacher.classes.viewRecord' ,compact('chartDataArray','lessondata','ClassId','id','user','tasmiRec','class','month','year','monthselect','yearselect'));
    

        } catch (ModelNotFoundException $e) {
            // If model is not found, return a 404 response
            abort(404);
        }
      
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
 
    }

    



}