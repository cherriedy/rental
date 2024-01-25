<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Room\CreateRoomRequest;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return response()->json([
            'data' => $rooms,
            'status_code' => 200,
            'message' => 'Succesfully',
        ]);
    }

    public function store(CreateRoomRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']);

        /* DEVELOPER */
        $validated['exact_address'] = 'NULL';
        $validated['expiration_date'] = Carbon::now();
        /*END DEVELOPER */

        if ($room = Room::create($validated)) {
            $temporaryFiles = TemporaryFile::all();

            foreach ($temporaryFiles as $temporaryFile) {
                Storage::copy('images/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename, 'images/' . $temporaryFile->folder . '/' . $temporaryFile->filename);

                Image::create([
                    'name' => $temporaryFile->filename,
                    'path' => $temporaryFile->folder . '/' . $temporaryFile->filename,
                    'room_id' => $room->id,
                ]);

                Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);

                $temporaryFile->delete();
            }

            return response()->json([
                'status_code' => '200',
                'message' => 'Đăng bài thành công!',
            ]);
        } else {
            $temporaryImages = TemporaryFile::all();

            foreach ($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }
        }
    }
}
