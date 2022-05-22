<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;

class ProjectController extends Controller
{
    public function index()
    {
        return view('Project/index', ['projects' => Project::all()]);
    }

    public function create()
    {
        $project = new Project;

        $project->project_name = htmlspecialchars($_POST['project_name']);
        $project->number_of_groups = htmlspecialchars($_POST['number_of_groups']);
        $project->students_per_group = htmlspecialchars($_POST['students_per_group']);

        $project->save();

        return view('Project/index', ['projects' => Project::all()]);
    }

    public function show(string $id)
    {   
        $project = Project::where('id', $id)->firstOrFail();

        return view('Project/dashboard', [
            'project' => $project,
            'students' => Student::where('project_name', $project['project_name'])->get()
        ]);
    }
}
