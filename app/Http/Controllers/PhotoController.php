<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Models\Advertisement;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{

    public function deleteFile(Advertisement $advertisement) {
        dd($advertisement);
        $photoPath = $request->input('path');
       
        // Usuwanie pliku z systemu plików
        if (File::exists(public_path('storage/' . $photoPath))) {
            File::delete(public_path('storage/' . $photoPath));
            return response()->json(['message' => 'Plik został usunięty.']);
        } else {
            return response()->json(['error' => 'Plik nie istnieje.']);
        }
    }
   
    
    
    

    

    // Usuwanie zdjęcia
   // public function delete($photoPaths)
    public function delete(Request $request)
    {
        dd($request);
       // $photo = Photo::find($id);
        $photo = Advertisement::all();
//dd($photo);
        if (!$photo) {
            return response()->json(['message' => 'Zdjęcie nie istnieje.'], 404);
        }

        // Usuń zdjęcie z serwera (jeśli potrzebne)
        // Usuń ścieżkę z pliku JSON
        $photoPaths = json_decode($photo->photos, true);
        // Znajdź indeks zdjęcia do usunięcia
        $index = array_search($photo->path, $photoPaths);
        if ($index !== false) {
            unset($photoPaths[$index]);
        }
        $photo->photos = json_encode(array_values($photoPaths));
        $photo->save();

        return response()->json(['message' => 'Zdjęcie usunięte pomyślnie.']);
    }

    // Obracanie zdjęcia
    public function rotate($id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json(['message' => 'Zdjęcie nie istnieje.'], 404);
        }

        // Obróć zdjęcie (jeśli potrzebne)
        // Zaktualizuj ścieżkę do obróconego zdjęcia
        $rotatedPath = 'sciezka-do-obroconego-zdjecia.jpg';
        $photo->path = $rotatedPath;
        $photo->save();

        return response()->json(['message' => 'Zdjęcie obrócone pomyślnie.', 'rotated_path' => $rotatedPath]);
    }
}
