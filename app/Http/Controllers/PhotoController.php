<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;


class PhotoController extends Controller
{
    public function store(Request $request, Album $album)
    {
        $request->validate([
            'photos.*' => 'image|required',
        ]);

        foreach ($request->file('photos') as $photo) {
            // Get the base name of the file (without extension)
            $baseName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
    
            // Save the file to the 'photos' directory in the public folder
            $path = $photo->store('photos', 'public');
    
            Photo::create([
                'album_id' => $album->id,
                'image_path' => $path,
                'name' => $baseName,
            ]);
        }

        return response()->json(['success' => 'Photos uploaded successfully']);
    }

    public function destroy($photoId, $photo)
    {
        $photo = Photo::findOrFail($photo);

        if ($photo) {
            // Delete the photo file from storage
            $photoPath = public_path($photo->image_path);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
            
            $photo->delete();
            return redirect()->back();
        }
        
        return response()->json(['error' => 'Photo not found'], 404);
    }
}
