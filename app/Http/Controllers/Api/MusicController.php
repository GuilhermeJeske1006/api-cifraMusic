<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MusicResource::collection(Music::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        request()->validate([
            'title' => 'required',
            'lyrics' => 'required'
        ]);
        
        $music = user()->musics()
            ->create([
                'title' => request()->title,
                'singer_id' => request()->singer_id,
                'note_id' => request()->note_id,
                'bpm' => request()->bpm,
                'rhythm_id' => request()->rhythm_id,
                'lyrics' => request()->lyrics,
                'created_by' => request()->created_by,
            ]);
    
        return MusicResource::make($music);
    }
    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Music $music)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        //
    }
}
