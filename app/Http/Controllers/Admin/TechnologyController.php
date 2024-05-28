<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Functions\Helper as Help;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        // $projects = Project::paginate(15);
        return view('admin.technologies.index', compact('technologies'));
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

        // dd($request->all());
        // prima di inserire una nuovo progetto verifico che non sia presente
        // se esiste ritorno alla index con un messaggio di errore
        // se non esiste la salvo e ritorno alla index con un messaggio di success
        $exixts = Technology::where('name', $request->name)->first();
        if ($exixts) {
            return redirect()->route('admin.technologies.index')->with('error', 'Technology già esistente');
        } else {
            $new = new Technology();
            $new->name = $request->name;
            $new->slug = Help::generateSlug($new->name, Technology::class);
            $new->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Technology creata correttamente');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        // dd($technology);
        /*
            1. validare il dato
            2. controllare se esiste già
        */
        // se esiste ritorno alla index con un messaggio di errore
        // se non esiste la salvo e ritorno alla index con un messaggio di success
        $val_data = $request->validate(
            [
                'name' => 'required|max:30',

            ],
            [
                'name.required' => 'Devi inserire il nome della technology',
                'name.max' => 'La technology non deve avere piu di :max caratteri',


            ]
        );

        $exixts = Technology::where('name', $request->name)->first();
        if ($exixts) {
            return redirect()->route('admin.technologies.index')->with('error', 'Technology già esistente');
        } else {

            $val_data['slug'] = Help::generateSlug($request->name, Technology::class);

            $technology->update($val_data);

            return redirect()->route('admin.technologies.index')->with('success', 'Technology modificata correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technology eliminata correttamente');
    }
}
