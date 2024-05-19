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

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Auth::user()->albums()->create($request->all());
        return redirect()->route('albums.index');
    }

    public function edit(Album $album)
    {
        // $this->authorize('update', $album);
        // return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        // $this->authorize('update', $album);
        $request->validate(['name' => 'required']);
        $album->update($request->all());
        return redirect()->route('albums.index');
    }

    public function destroy(Album $album)
    {
        // $this->authorize('delete', $album);
        if ($album->photos()->count() > 0) {
            // Provide options to delete or move photos
            return view('albums.confirm-delete', compact('album'));
        }
        $album->delete();
        return redirect()->route('albums.index');
    }
}
