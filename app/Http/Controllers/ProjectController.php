<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
      private function getAllStatuses()
      {
              return Status::orderBy('name')->get();
      }
      public function index()
      {
             $statuses = $this->getAllStatuses();
             $projects = Project::orderBy('name')->get();
             return view('projects.index',compact('projects','statuses'));
      }

      public function create()
      {
             $statuses = $this->getAllStatuses();
             return view('projects.create',compact('statuses'));
      }

      public function store(ProjectRequest $request)
      {
             Project::create($request->validated());
             return redirect()->route('projects.index')->with('success','Project created successfully');
      }

      public function show(Project $project)
      {
             return view('projects.show',compact('project'));
      }

      public function edit(Project $project)
      {
             $statuses = $this->getAllStatuses();
             return view('projects.edit',compact('project','statuses'));
      }

      public function update(ProjectRequest $request, Project $project)
      {
             $project->update($request->validated());
             return redirect()->route('projects.index')->with('success','Project updated successfully');
      }

      public function destroy(Project $project)
      {
             $project->delete();
             return redirect()->back()->with('success','Project deleted successfully');
      }
}
