<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'price', 'user_id', 'photos'];

    public static function combineJsonFiles($file1,$file2)
    {
        // Logika łączenia plików JSON

        // Ścieżki do plików JSON
        //$file1 = 'plik1.json';
        //$file2 = 'plik2.json';

        // Odczytaj zawartość plików JSON
        $data1 = json_decode($file1, true);
        $data2 = json_decode($file2, true);

        // Połącz dane
        $combinedData = array_merge($data1, $data2);

        // Zapisz dane do nowego pliku JSON
        file_put_contents('combined.json', json_encode($combinedData, JSON_PRETTY_PRINT));

        echo 'Pliki JSON zostały połączone. '.json_encode($combinedData);
        return $combinedData;
    }
}
