<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MusicResource::collection(Music::paginate(10));
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
        return MusicResource::make($music);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Music $music)
    {    
        request()->validate([
            'title' => 'required',
            'lyrics' => 'required'
        ]);
        
        $music->title       = request()->title;
        $music->singer_id   = request()->singer_id;
        $music->note_id     = request()->note_id;
        $music->bpm         = request()->bpm;
        $music->rhythm_id   = request()->rhythm_id;
        $music->lyrics      = request()->lyrics;
        $music->created_by  = request()->created_by;

        $music->save();

        return MusicResource::make($music);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        $music->deleteOrFail();

        return MusicResource::make($music);
    }
}
