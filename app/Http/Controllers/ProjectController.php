<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {

        return view('index', ['projects' => Project::all()]);
    }

    public function create()
    {
        // $project = Project::create([
        //     'project_name' => htmlspecialchars($_POST['project_name']),
        //     'number_of_groups' => htmlspecialchars($_POST['number_of_groups']),
        //     'students_per_group' => htmlspecialchars($_POST['students_per_group'])
        // ]);

        $project = new Project;

        $project->project_name = htmlspecialchars($_POST['project_name']);
        $project->number_of_groups = htmlspecialchars($_POST['number_of_groups']);
        $project->students_per_group = htmlspecialchars($_POST['students_per_group']);

        $project->save();

        return view('index', ['projects' => Project::all()]);
    }
}
