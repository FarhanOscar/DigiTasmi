<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\TeacherClass;
use App\models\EnrollClass;
use App\models\User;
use App\models\Surah;
use App\models\SurahTrackerModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SurahTrackerController extends Controller
{
    //
    public function index(Request $request)
    {
        //

        if(Gate::denies('manage-lessons'))
        {
            abort(403);
        };

        $user = Auth::id();
        $surahdata = Surah::all()->sortBy('sequences');
        $trackerdata = SurahTrackerModel::where('TrackerUserId',$user)->get();

       




        return view('student.tracker.index',compact('surahdata','trackerdata'));    
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

        $trackerdata = new SurahTrackerModel();
        $id = $request->input('TrackerSurahId');

        $user = Auth::id(); 
        // $existingSurah = SurahTrackerController::where('TrackerSurahId', $id)->exists();
        // $existingStudent = SurahTrackerController::where('TrackerUserId', $user)->exists();
        $existingRow = SurahTrackerModel::where('TrackerSurahId', $id)
        ->where('TrackerUserId', $user)
        ->exists();

        try {
            // Check if the record already exists
            $existingRow = SurahTrackerModel::where('TrackerSurahId', $id)
                ->where('TrackerUserId', $user)
                ->exists();
        
            if ($existingRow) {
                // Update the existing row
                $TrackerSurah = $request->input('TrackerSurahId');
                $TrackerUser = $user;
                $TrackerStat = $request->input('TrackerStatus');
                $TrackerSurahAyat = $request->input('TrackerSurahAyat');
                $TrackerDeadLine = $request->input('TrackerDeadLine');
        
                SurahTrackerModel::where('TrackerSurahId', $id)
                    ->where('TrackerUserId', $user)
                    ->update([
                        'TrackerSurahId' => $TrackerSurah,
                        'TrackerUserId' => $TrackerUser,
                        'TrackerStatus' => $TrackerStat,
                        'TrackerSurahAyat' => $TrackerSurahAyat,
                        'TrackerDeadLine' => $TrackerDeadLine,
                    ]);
        
                return redirect()->route('student.tracker.index')->with('success', 'Tracker Updated');
            } else {
                // Create new records
                $trackerdata = new SurahTrackerModel(); // Replace with your actual model class
                $trackerdata->TrackerSurahId = $request->input('TrackerSurahId');
                $trackerdata->TrackerUserId = $user;
                $trackerdata->TrackerStatus = $request->input('TrackerStatus');
                $trackerdata->TrackerSurahAyat = $request->input('TrackerSurahAyat');
                $trackerdata->TrackerDeadLine = $request->input('TrackerDeadLine');
                $trackerdata->save();
        
                return redirect()->route('student.tracker.index')->with('success', 'New Tracker Updated');
            }
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            return redirect()->route('student.tracker.index')->with('error', 'Error: ' . $e->getMessage());
        }
        
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


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ClassId,$id)
    {
    }

}
