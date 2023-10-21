<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdvertisementController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            //$advertisements = Advertisement::where('user_id', $user->id)->get(); 
            $advertisements = Advertisement::where('user_id', $user->id)
                ->orderBy('created_at', 'desc') // Sortuj od najnowszego do najstarszego
                ->get();
        } else {
            // Pobierz ogłoszenia posortowane według daty w odwrotnej kolejności
            $advertisements = Advertisement::orderBy('created_at', 'desc')->get();
            //$advertisements = Advertisement::all();
        }
        return view('advertisements.index', compact('advertisements'));
    }

    public function create()
    {
        return view('advertisements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
        ]);
        $data['user_id'] = auth()->user()->id; // Przypisz ID zalogowanego użytkownika
        $photoPaths = [];

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');

            foreach ($photos as $photo) {
                $filename = $data['user_id'] . '_' . time() . '_' . $photo->getClientOriginalName();
                $photo = Image::make($photo)->resize(800, 600)->encode('jpg', 80);
                $photo->save(public_path('storage/advertisements/' . $data['user_id'] . '/' . $filename));
                $photoPaths[] = 'advertisements/' . $data['user_id'] . '/' . $filename;
            }
            $photoPaths = 'json_encode'($photoPaths);
            // Zapisz ścieżki zdjęć w polu "photos" modelu Advertisement

        }
        $data['photos'] = $photoPaths;
        Advertisement::create($data);

        return redirect('advertisements.index')->with('success', 'Ogłoszenie zostało dodane.');
        //return redirect()->route('home')->with('success', 'Ogłoszenie zostało dodane.');

    }

    public function destroy(Advertisement $advertisement)
    {
        // Upewnij się, że użytkownik ma uprawnienia do usunięcia ogłoszenia
        if ($advertisement->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Nie masz uprawnień do usunięcia tego ogłoszenia.');
        }
        // Usuń ogłoszenie
        $advertisement->delete();

        return redirect()->route('advertisements.index')->with('success', 'Ogłoszenie zostało usunięte.');
    }

    public function edit($id)
    {
        $advertisement = Advertisement::find($id);
        return view('advertisements.edit', compact('advertisement'));
    }

    public function update(Request $request, $id)
    {
        // Walidacja danych
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
        $advertisement = Advertisement::find($id);

        //aktualizacja zdjęć
        $data['user_id'] = auth()->user()->id; // Przypisz ID zalogowanego użytkownika
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            foreach ($photos as $photo) {
                $filename = $data['user_id'] . '_' . time() . '_' . $photo->getClientOriginalName();
                $photo = Image::make($photo)->resize(800, 600)->encode('jpg', 80);
                $photo->save(public_path('storage/advertisements/' . $data['user_id'] . '/' . $filename));
                $photoPaths[] = 'advertisements/' . $data['user_id'] . '/' . $filename;
            }
            $photoPaths = 'json_encode'($photoPaths);
            $photoPaths = Advertisement::combineJsonFiles($photoPaths, $advertisement->photos);
            $data['photos'] = 'json_encode'($photoPaths);
        }
        $advertisement->update($data);
        return redirect()->route('advertisements.index', $id)->with('success', 'Ogłoszenie zostało zaktualizowane.');
    }

    public function show(Request $request, $id)
    {
        $advertisement = Advertisement::find($id);
        return view('advertisements.show', compact('advertisement'));
    }


    public function updatePhotoOrder(Request $request, Advertisement $advertisement)
    {
        $newOrder = json_decode($request->input('photos'));

        // Aktualizuj kolejność zdjęć w bazie danych
        $advertisement->update(['photos' => json_encode($newOrder)]);

        return response()->json(['message' => 'Kolejność zdjęć została zaktualizowana.']);
    }
}
