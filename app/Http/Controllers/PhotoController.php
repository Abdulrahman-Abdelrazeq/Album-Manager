<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request, Album $album)
    {
        $request->validate(['name' => 'required', 'photos.*' => 'image']);
        foreach ($request->file('photos') as $photo) {
            $album->addMedia($photo)->toMediaCollection('photos');
        }
        return redirect()->route('albums.show', $album);
    }

    public function destroy(Album $album, Photo $photo)
    {
        $photo->delete();
        return redirect()->route('albums.show', $album);
    }
}
