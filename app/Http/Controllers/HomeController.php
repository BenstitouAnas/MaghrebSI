<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user())
        {
            if(Auth::user()->typeUser == 0) return redirect('/admin');
            if(Auth::user()->typeUser == 2) return redirect('/Prestataires');
            if(Auth::user()->typeUser == 1) return redirect('/Commerciales');
        }

        return view('home');
    }
}
