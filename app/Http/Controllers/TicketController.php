<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\UtilisateurPro;
use App\User;

use DB;

class TicketController extends Controller
{
    public function showTtickets(){
        $tickets =  DB::table('tickets')->where('utilisateur_rece', auth::user()->getAuthIdentifier())
               ->orderBy('created_at', 'desc')
               ->get();

        return view('utilisateurpro.tickets', compact('tickets'));
    }


    
}
