<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\EnrollClass;
use App\models\Surah;
use App\models\TeacherClass;
use Illuminate\Support\Facades\DB;
use \Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\models\User;

use App\models\TasmiRecord;




class TasmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $counter=1;

    public function index()
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
      

        
        $tasmiRec = new TasmiRecord();

        $tasmiRec->TasmiStudentId = $request->input('TasmiStudentId');


        $tasmiRec->TasmiSurahId = $request->input('TasmiSurah');
        $tasmiRec->TasmiSurahPage = $request->input('inputPage');

        $tasmiRec->TasmiSurahAyat = $request->input('inputAyat');
        $tasmiRec->TasmiSurahJuz = $request->input('inputJuz');
        $tasmiRec->TasmiStudentId = $request->input('TasmiStudentId');
        $tasmiRec->TasmiClassId = $request->input('TasmiClassId');



        $tasmiRec -> save();

        return redirect()->route('teacher.classes.index')->with('success', 'Succesfully update Tasmi Recoed.');


    }

    /**
     * Display the specified resource.
     */
    public function show($ClassId,$id)
    {
        //

        // $classdata = EnrollClass::where('EnrollStudentId',$id)->get();
try {
    $ClassId = Crypt::decrypt($ClassId);
    $id = Crypt::decrypt($id);
    $lessondata =  Surah::all();
    $user = User::find($id);
    $tasmiRec = TasmiRecord::where('TasmiStudentId', $id)->where('TasmiClassId', $ClassId)->orderBy('created_at','desc')->paginate(4);



    return view('teacher.classes.tasmiForm' ,compact('lessondata','ClassId','id','user','tasmiRec'));

} catch (DecryptException $e) {
    
    abort(404);
    
}
        
    }

    public function showRecord($ClassId,$id,Request $request)
    {
        //

        // $classdata = EnrollClass::where('EnrollStudentId',$id)->get();
try {
    $ClassId = Crypt::decrypt($ClassId);
    $id = Crypt::decrypt($id);
    $lessondata =  Surah::all();
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

} catch (DecryptException $e) {
    
    abort(404);
}
      
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // $classdata = TeacherClass::where('id',$id)->get();

        // $studentenroll = EnrollClass::where('EnrollClassId', $id)->get();

        



        // return view('teacher.classes.tasmiForm',compact('ClassId','id'));

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
     * Remove the class participant .
     */
    public function destroy($ClassId,$id)
    {
      
try {
    $ClassId = Crypt::decrypt($ClassId);
    $id = Crypt::decrypt($id);
    $class = EnrollClass::where('EnrollClassId', $ClassId)->where('EnrollStudentId', $id)->first();
    $class->delete();

        return redirect()->route('teacher.classes.index')->with('alert', 'Participant Deleted');
} catch (DecryptException $e) {
    
}

     
       


    }
}
