<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index() {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store() {
        //validate

        //persists
        Project::create(request(['title', 'description']));

        //redirects
        return redirect('/projects')
    }
}
