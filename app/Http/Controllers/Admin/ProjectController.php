<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Functions\Helper as Help;
use App\Http\Requests\ProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['toSearch'])) {

            $projects = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->paginate(15);
        } else {
            // $projects = Project::all();
            $projects = Project::orderBy('id', 'desc')->paginate(15);
        }



        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();

        return view('admin.projects.create', compact('technologies', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        // prima di inserire una nuovo progetto verifico che non sia presente
        // se esiste ritorno alla index con un messaggio di errore
        // se non esiste la salvo e ritorno alla index con un messaggio di success

        // $exixts = Project::where('title', $request->title)->first();
        // if ($exixts) {
        //     return redirect()->route('admin.projects.index')->with('error', 'Progetto già esistente');
        // } else {
        //     $new = new Project();
        //     $new->title = $request->title;
        //     $new->slug = Help::generateSlug($new->title, Project::class);
        //     $new->description = $request->description;
        //     $new->creation_date = $request->creation_date;
        //     $new->save();

        //     return redirect()->route('admin.projects.index')->with('success', 'Progetto creato correttamente');
        // }

        $form_data = $request->all();


        // verifico l'esistenza della chiave 'image' in $form_data
        if (array_key_exists('image', $form_data)) {
            // salvo l'immagine nello store
            $image_path = Storage::put('upload', $form_data['image']);
            $form_data['image'] = $image_path;
        }

        $form_data['slug'] = Help::generateSlug($form_data['title'], Project::class);

        $new = new Project();
        $new->fill($form_data);
        $new->save();

        // l'associazione many to many deve avvenire dopo il salvataggio del dato nel db
        // se trovo la chiave types inserisco la relazione nella tabella pivot
        if (array_key_exists('types', $form_data)) {
            $new->types()->attach($form_data['types']);
        }

        return redirect()->route('admin.projects.show', $new)->with('success', 'Progetto creato correttamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // dd($project);
        return redirect()->route('admin.projects.index')->with('success', 'Progetto aggiunto correttamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'technologies', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        /*
            1. validare il dato
            2. controllare se esiste già
        */
        // se esiste ritorno alla index con un messaggio di errore
        // se non esiste la salvo e ritorno alla index con un messaggio di success

        // return view('admin.projects.update');

        $val_data = $request->validate(
            [
                'title' => 'required|min:2|max:100',
                'description' => 'required',
                'creation_date' => 'nullable',

            ],
            [
                'title.required' => 'Devi inserire il nome del progetto',
                'title.min' => 'Il progetto deve avere almeno :min caratteri',
                'title.max' => 'Il progetto non deve avere piu di :max caratteri',
                'description.required' => 'Devi inserire la descrizione del progetto',

            ]
        );

        $exixts = Project::where('title', $request->title)->first();
        if ($exixts) {
            return redirect()->route('admin.projects.index')->with('error', 'Progetto già esistente');
        } else {

            $val_data['slug'] = Help::generateSlug($request->title, Project::class);
            $val_data['description'] = $request->description;
            $val_data['creation_date'] = $request->creation_date;
            $project->update($val_data);

            if (array_key_exists('types', $val_data)) {
                //aggiorno tutte le relazioni eliminando quelle che eventualmente non ci sono più
                // ->sync() accetta un'array sincronizzando tutte le relazioni
                $project->type()->sync($val_data['types']);

                // $project->types()->sync($request->input('types', []));
            } else {
                // se non sono presenti id dentro types elimino tutte le relazioni con project
                $project->types()->detach();
            }
            // $project->update($val_data);

            return redirect()->route('admin.projects.index')->with('success', 'Progetto modificato correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato correttamente');
    }
}
