<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

class StudentController extends Controller
{
    public function create(string $id)
    {
        $project = Project::where('id', $id)->firstOrFail();
        
        return view('Student/create', [
            'project' => $project
        ]);
    }

    public function store(string $id)
    {
        $errMessage = '';
        $project = Project::where('id', $id)->firstOrFail();
        $students = Student::all();

        $student = new Student;
        $student->project_name = $project['project_name'];
        $student->student_name = htmlspecialchars($_POST['student_name']);
        $student->group = '-';
        
        foreach($students as $existingStudent) {
            if ($existingStudent['student_name'] === $student->student_name) {
                $errMessage = 'Student already exists';

                return view('Student/create', [
                    'project' => $project,
                    'errMessage' => $errMessage
                ]);
            }
        }

        $student->save();

        return view('Project/dashboard', [
            'project' => $project,
            'students' => Student::where('project_name', $project['project_name'])->get()
        ]);
    }

    public function delete(string $project_id, string $student_id)
    {
        Student::find($student_id)->delete();
        $project = Project::where('id', $project_id)->firstOrFail();

        return view('Project/dashboard', [
            'project' => $project,
            'students' => Student::where('project_name', $project['project_name'])->get()
        ]);
    }

    public function update(string $project_id, string $group)
    {   
        $student_id = '';
        foreach($_POST as $key => $value) {
            if ($value === '') continue;
            $name = explode('_', $key);
            $name = $name[0];
            if ($name === 'assigned') $student_id = $value;

        }

        $student = Student::find($student_id);
        $student->group = $group;
        $student->save();
        $project = Project::where('id', htmlspecialchars($project_id))->firstOrFail();

        return view('Project/dashboard', [
            'project' => $project,
            'students' => Student::where('project_name', $project['project_name'])->get()
        ]);
    }
}
