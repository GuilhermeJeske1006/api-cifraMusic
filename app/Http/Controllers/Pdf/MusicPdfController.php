<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\{Music, Rhythm, Singer};
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class MusicPdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Music $music): Response
    {
        $data = [
            'singer' => Singer::where('id', $music->singer_id)->first(),
            'note'   => Music::where('id', $music->note_id)->first(),
            'rhythm' => Rhythm::where('id', $music->rhythm_id)->first(),
            'bpm'    => $music->bpm,
            'title'  => $music->title,
            'lyrics' => $music->lyrics,
        ];

        $pdf = Pdf::loadView('pdf.onlyMusic', compact('data'));

        return $pdf->setPaper('a4')->stream('pdf.onlyMusic');
    }

}
