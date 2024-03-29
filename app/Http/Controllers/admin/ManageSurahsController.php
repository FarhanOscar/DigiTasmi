<?php

namespace App\Http\Controllers\admin;
use \Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Surah;

use Illuminate\Support\Facades\Gate;

class ManageSurahsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        if(Gate::denies('manage-users'))
        {
            abort(403);
        };


        $surahdata = Surah::all()->sortBy('sequences');







        return view('admin.surahs.index' , compact('surahdata'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.surahs.addSurah' );    

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

               
        $surahdata = new Surah();
        
        
        
        
        
        
      
            $surahdata->SurahName = $request->get('SurahName');
            $surahdata->SurahMinJuz = $request->get('SurahMinJuz');
            $surahdata->SurahMaxJuz = $request->get('SurahMaxJuz');
            $surahdata->SurahMinPage = $request->get('SurahMinPage');
            $surahdata->SurahMaxPage = $request->get('SurahMaxPage');
            $surahdata->SurahMaxAyat = $request->get('SurahMaxAyat');
            $surahdata->sequences = $request->get('sequences');

            $surahdata->save();



        
        

        return redirect()->route('admin.surahs.index')->with('success', 'Surah successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
            $surahdata = Surah::where('id',$id)->get();

            return view('admin.surahs.updateSurah' ,compact('surahdata') );    
        } catch (DecryptException $e) {
            abort(404);
        }
       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
                   
        $surahdata = Surah::find($id);


        if (!$surahdata) {
            return redirect()->route('admin.classes.index')->with('error', 'Class not found.');
        }
        $surahdata->SurahName = $request->get('SurahName');
        $surahdata->SurahMinJuz = $request->get('SurahMinJuz');
        $surahdata->SurahMaxJuz = $request->get('SurahMaxJuz');
        $surahdata->SurahMinPage = $request->get('SurahMinPage');
        $surahdata->SurahMaxPage = $request->get('SurahMaxPage');
        $surahdata->SurahMaxAyat = $request->get('SurahMaxAyat');
        $surahdata->sequences = $request->get('sequences');
            $surahdata->save();


        
    

        return redirect()->route('admin.surahs.index')->with('success', 'Surah successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $surahdata = Surah::find($id);
        $surahdata->delete();

        return redirect()->route('admin.surahs.index')->with('alert', 'Surah deleted.');

    }
}
