<?php

namespace App\Http\Controllers\Pdf\Api;

use App\Http\Controllers\Controller;
use App\Models\{Handout, Music, Note, Rhythm, Singer};
use Illuminate\Http\{JsonResponse, Response};
use Illuminate\Support\Facades\Storage;
use TCPDF;

class DownloadHandoutController extends Controller
{
    public function __invoke(): JsonResponse
    {
        try {
            $data = [];

            if (request()->data && is_array(request()->data) && !empty(request()->data)) {
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
            } else {
                return response()->json(['error' => 'Request data is missing or empty.']);
            }

            $base64Image              = request()->input('cover_image');
            list($type, $base64Image) = explode(';', $base64Image);
            list(, $base64Image)      = explode(',', $base64Image);
            $imageData                = base64_decode($base64Image);
            $imageName                = 'image_' . time() . '.png';
            $imagePath                = 'cover_img/' . $imageName;
            Storage::disk('s3')->put($imagePath, $imageData, 'public');

            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdfContent = view('pdf.handout', compact('data'))->render();
            $pdf->writeHTML($pdfContent);
            $pdfPath = 'pdf/music_pdf_' . time() . '.pdf';
            Storage::disk('s3')->put($pdfPath, $pdf->output('S'), 'public');

            $handout                   = new Handout();
            $handout->title            = request()->title;
            $handout->subtitle         = request()->subtitle;
            $handout->cover_image      = $imageName;
            $handout->handout_download = $pdfPath;
            $handout->save();

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }

    }
}
