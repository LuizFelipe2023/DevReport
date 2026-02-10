<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download(Document $document)
    {
        $path = $document->file_path;

        if (!Storage::disk('public')->exists($path)) {
            return back()->with('error', 'Arquivo não encontrado no servidor.');
        }

        return response()->download(
            Storage::disk('public')->path($path),
            $document->original_name
        );
    }
}