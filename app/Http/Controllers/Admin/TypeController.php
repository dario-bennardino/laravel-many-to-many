<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper as Help;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        // $projects = Project::paginate(15);
        return view('admin.types.index', compact('types'));
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
        // prima di inserire una nuovo type verifico che non sia presente
        // se esiste ritorno alla index con un messaggio di errore
        // se non esiste la salvo e ritorno alla index con un messaggio di success
        $exixts = Type::where('name', $request->name)->first();
        if ($exixts) {
            return redirect()->route('admin.types.index')->with('error', 'Technology già esistente');
        } else {
            $new = new Type();
            $new->name = $request->name;
            $new->slug = Help::generateSlug($new->name, Type::class);
            $new->save();

            return redirect()->route('admin.types.index')->with('success', 'Technology creata correttamente');
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
    public function update(Request $request, Type $type)
    {
        // dd($type);
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
                'name.required' => 'Devi inserire il nome del Type',
                'name.max' => 'Il Type non deve avere piu di :max caratteri',


            ]
        );

        $exixts = Type::where('name', $request->name)->first();
        if ($exixts) {
            return redirect()->route('admin.types.index')->with('error', 'Type già esistente');
        } else {

            $val_data['slug'] = Help::generateSlug($request->name, Type::class);

            $type->update($val_data);

            return redirect()->route('admin.types.index')->with('success', 'Type modificata correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Type eliminata correttamente');
    }
}
