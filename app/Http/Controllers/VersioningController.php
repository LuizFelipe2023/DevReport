<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersioningRequest;
use App\Models\Project;
use App\Models\Versioning;
use Illuminate\Http\Request;

class VersioningController extends Controller
{

       private function getAllProjects()
       {
              return Project::orderBy('name')->get();
       }

       public function index()
       {
              $versionings = Versioning::with('project')->get();
              return view('versionings.index', compact('versionings'));
       }

       public function show(Versioning $versioning)
       {
              return view('versionings.show', compact('versioning'));
       }

       public function create()
       {
              $projects = $this->getAllProjects();
              return view('versionings.create', compact('projects'));
       }

       public function store(VersioningRequest $request)
       {
              $versioning = Versioning::create($request->validated());

              if ($request->filled('users')) {
                     $versioning->users()->attach($request->input('users'));
              }

              return redirect()->route('versionings.index')
                     ->with('success', 'Versioning created successfully');
       }

       public function edit(Versioning $versioning)
       {
              $projects = $this->getAllProjects();
              return view('versionings.edit', compact('versioning', 'projects'));
       }

       public function update(VersioningRequest $request, Versioning $versioning)
       {
              $versioning->update($request->validated());

              if ($request->filled('users')) {
                     $versioning->users()->syncWithoutDetaching($request->input('users'));
              }

              return redirect()->route('versionings.index')
                     ->with('success', 'Versioning updated successfully');
       }


       public function destroy(Versioning $versioning)
       {
              $versioning->delete();
              return redirect()->route('versionings.index')->with('success', 'Versioning deleted successfully');
       }
}
