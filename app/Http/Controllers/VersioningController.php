<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersioningRequest;
use App\Models\Project;
use App\Models\Versioning;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\Storage;

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
        $versionings = Versioning::with(['status', 'project', 'documents'])->get();
        $users = $this->getAllUsers();
        return view('versionings.index', compact('versionings', 'users', 'statuses'));
    }

    public function show(Versioning $versioning)
    {
        $versioning->load('documents', 'users', 'project', 'status');
        return view('versionings.show', compact('versioning'));
    }

    public function create()
    {
        $users = $this->getAllUsers();
        $projects = $this->getAllProjects();
        $statuses = $this->getAllStatuses();
        return view('versionings.create', compact('projects', 'users', 'statuses'));
    }

    public function store(VersioningRequest $request)
    {

        $versioning = Versioning::create($request->validated());


        if ($request->filled('users')) {
            $versioning->users()->attach($request->input('users'));
        }


        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('version_docs', 'public');

                $versioning->documents()->create([
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_ext' => $file->getClientOriginalExtension()
                ]);
            }
        }

        return redirect()->route('versionings.index')
            ->with('success', 'Versionamento e documentos criados com sucesso!');
    }

    public function edit(Versioning $versioning)
    {
        $versioning->load('documents');
        $users = $this->getAllUsers();
        $projects = $this->getAllProjects();
        $statuses = $this->getAllStatuses();
        return view('versionings.edit', compact('versioning', 'projects', 'users', 'statuses'));
    }

    public function update(VersioningRequest $request, Versioning $versioning)
    {
        $versioning->update($request->validated());

       
        if ($request->has('remove_documents')) {
            foreach ($request->input('remove_documents') as $docId) {
                
                $doc = $versioning->documents()->find($docId);

                if ($doc) {
                    Storage::disk('public')->delete($doc->file_path);
                    $doc->delete();
                }
            }
        }

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('version_docs', 'public');
                $versioning->documents()->create([
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_ext' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        $versioning->users()->sync($request->users);

        return redirect()->route('versionings.index')->with('success', 'Alterações salvas com sucesso!');
    }

    public function destroy(Versioning $versioning)
    {
        foreach ($versioning->documents as $document) {
            Storage::disk('public')->delete($document->file_path);
        }

        $versioning->delete();
        return redirect()->route('versionings.index')->with('success', 'Versionamento e arquivos removidos!');
    }

    public function generatePdf()
    {
        $versioningsGrouped = Versioning::with(['project', 'users', 'status'])
            ->get()
            ->groupBy('project_id');

        $pdf = Pdf::loadView('versionings.pdfVersionings', compact('versioningsGrouped'));

        return $pdf->download('relatorio_versoes_por_projeto.pdf');
    }

    public function destroyDocument(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return back()->with('success', 'Documento removido com sucesso!');
    }
}