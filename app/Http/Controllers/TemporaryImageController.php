<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class TemporaryImageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('images/tmp/' . $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $fileName,
            ]);

            return $folder;
        }

        return '';
    }

    public function destroy(Request $request) {
        $temporaryFile = TemporaryFile::where('folder', $request->getContent())->first();

        if ($temporaryFile) {
            Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);

            $temporaryFile->delete();
        }

        return response()->noContent();
    }
}
