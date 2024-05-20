<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;


class AlbumController extends Controller
{
    public function index()
    {
        $albums = Auth::user()->albums;
        return view('albums.index', compact('albums'));
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Auth::user()->albums()->create($request->all());
        return redirect()->route('albums.index');
    }

    public function update(Request $request, Album $album)
    {
        $request->validate(['name' => 'required']);
        $album->update($request->all());
        return redirect()->route('albums.index');
    }

    public function destroy(Album $album)
    {
        if ($album->photos()->count() > 0) {
            // Provide options to delete or move photos
            return view('albums.confirm-delete', compact('album'));
        }
        $album->delete();
        return redirect()->route('albums.index');
    }




    public function deleteAllPhotos(Request $request)
    {
        $album = Album::findOrFail($request->album_id);

        foreach ($album->photos as $photo) {
            $photoPath = public_path($photo->image_path);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
            $photo->delete(); // Delete photo from database
        }
        $album->delete();
        return response()->json(['success' => 'All photos deleted successfully.']);
    }

    public function movePhotos(Request $request, $albumId)
    {
        $album = Album::findOrFail($albumId);
        $targetAlbum = Album::findOrFail($request->target_album);

        foreach ($album->photos as $photo) {
            $photo->album_id = $targetAlbum->id;
            $photo->save();
        }
        $album->delete();
        return redirect()->back();
    }
}
