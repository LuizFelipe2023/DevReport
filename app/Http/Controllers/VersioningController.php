<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersioningRequest;
use App\Models\Project;
use App\Models\Versioning;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;

class VersioningController extends Controller
{
       private function getAllStatuses()
       {
              return Status::orderBy('name')->get();
       }

       private function getAllUsers()
       {
              return User::orderBy('name')->get();
       }
       private function getAllProjects()
       {
              return Project::orderBy('name')->get();
       }

       public function index()
       {
              $statuses = $this->getAllStatuses();
              $versionings = Versioning::with(['status','project'])->get();
              $users = $this->getAllUsers();
              return view('versionings.index', compact('versionings', 'users','statuses'));
       }

       public function show(Versioning $versioning)
       {
              return view('versionings.show', compact('versioning'));
       }

       public function create()
       {
              $users = $this->getAllUsers();
              $projects = $this->getAllProjects();
              $statuses = $this->getAllStatuses();
              return view('versionings.create', compact('projects', 'users','statuses'));
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
              $users = $this->getAllUsers();
              $projects = $this->getAllProjects();
              $statuses = $this->getAllStatuses();
              return view('versionings.edit', compact('versioning', 'projects', 'users','statuses'));
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

       public function generatePdf()
       {
              $versioningsGrouped = Versioning::with(['project', 'users','status'])
                     ->get()
                     ->groupBy('project_id');

              $pdf = Pdf::loadView('versionings.pdfVersionings', compact('versioningsGrouped'));

              return $pdf->download('relatorio_versoes_por_projeto.pdf');
       }
}
