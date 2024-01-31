<?php

namespace App\Http\Controllers\Api\WebScraping;

use App\Http\Controllers\Controller;
use App\Models\{Music, Note, Singer};
use Goutte\Client;
use Illuminate\Http\{JsonResponse, Request};
use PhpParser\Node\Stmt\{Return_, TryCatch};
use PHPUnit\Framework\MockObject\Stub\{ReturnArgument, ReturnValueMap};

class StoreMusicController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Client $client): JsonResponse
    {
        try {
            $name_singer = $this->sanitizeString(request()->name_singer);
            $name_music  = $this->sanitizeString(request()->name_music);

            $crawler = $client->request('GET', env('WEB_SCRIPING_URL') . '/' . $name_singer . '/' . $name_music . '/simplificada.html');

            $song_raw = $crawler->filter('.cifra-column--left')->html();

            // Remove content inside the 'tablatura' class
            $song = $this->removeTablatura($song_raw);

            $title  = $crawler->filter('.t1')->text();
            $singer = $crawler->filter('.t3')->text();
            $note   = $this->sanitizeNote($crawler->filter('#cifra_tom')->text());

            $noteId   = $this->getOrCreateNoteId($note);
            $singerId = $this->getOrCreateSingerId($singer);

            $music             = new Music();
            $music->title      = $title;
            $music->singer_id  = $singerId;
            $music->note_id    = $noteId;
            $music->bpm        = null;
            $music->rhythm_id  = null;
            $music->lyrics     = $song;
            $music->created_by = 1;
            $music->save();

            return response()->json([
                'message' => 'Musica adicionada com sucesso',
                'data'    => $music,
            ], 201);

        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    // Restante do código permanece inalterado

    private function removeTablatura(string $content): string
    {
        // Utilize a expressão regular para remover a classe "tablatura" e seu conteúdo
        $pattern = '/<span class="tablatura"><span class="cnt">(.*?)<\/span><\/span>/s';

        return preg_replace($pattern, '', $content);
    }

    private function sanitizeString(string $input): string
    {
        return str_replace(' ', '-', $input);
    }

    private function sanitizeNote(string $note): string
    {
        return substr_replace($note, "", 0, 5);
    }

    private function getOrCreateNoteId(string $note): int
    {
        $existingNote = Note::where('name_note', $note)->first();

        if ($existingNote) {
            return $existingNote->id;
        }

        $newNote            = new Note();
        $newNote->name_note = $note;
        $newNote->save();

        return $newNote->id;
    }

    private function getOrCreateSingerId(string $singer): int
    {
        $existingSinger = Singer::where('name_singer', $singer)->first();

        if ($existingSinger) {
            return $existingSinger->id;
        }

        $newSinger              = new Singer();
        $newSinger->name_singer = $singer;
        $newSinger->save();

        return $newSinger->id;
    }

}
