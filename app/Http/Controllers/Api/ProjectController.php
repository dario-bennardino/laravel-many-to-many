<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // $project = Project::all();
        //$project = Project::with('technology')->paginate(10);

        $project = Project::with('technology', 'types')->paginate(10);
        // $success = true;

        return response()->json($project);
    }
}
