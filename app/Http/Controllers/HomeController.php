<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
       // $advertisements = Advertisement::all(); // Pobierz wszystkie ogłoszenia
       // return view('advertisements');
        //return view('advertisements.index');
       // return redirect('advertisements');
    }
}
