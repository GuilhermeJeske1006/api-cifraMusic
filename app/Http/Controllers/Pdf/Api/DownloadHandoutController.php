<?php

namespace App\Http\Controllers\Pdf\Api;

use App\Http\Controllers\Controller;
use App\Models\{Music, Note, Rhythm, Singer};
use Illuminate\Http\{JsonResponse, Response};
use TCPDF;

class DownloadHandoutController extends Controller
{
    public function __invoke(): JsonResponse
    {
        try {
            $data = [];

            foreach (request()->data as $music) {
                $data[] = [
                    'singer' => Singer::find($music['singer_id']),
                    'note'   => Note::find($music['note_id']),
                    'rhythm' => Rhythm::find($music['rhythm_id']),
                    'bpm'    => $music['bpm'],
                    'title'  => $music['title'],
                    'lyrics' => $music['lyrics'],
                ];
            }

            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->writeHTML(view('pdf.handout', compact('data'))->render());
            $pdf->Output('music_pdf.pdf', 'I');

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
