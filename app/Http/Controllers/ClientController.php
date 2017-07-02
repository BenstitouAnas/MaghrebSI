<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

use DB;

class ClientController extends Controller
{
    
    
    public function showTtickets(){
        $tickets =  DB::table('ticketclients')->where('utilisateur_rece', '1')
               ->orderBy('created_at', 'desc')
               ->get();

        return view('client.tickets', compact('tickets'));
    }

    public function showDetaillesTicket($id){
        $messages = DB::table('messageclients')->where('ticket_id', $id)
               ->orderBy('created_at', 'desc')
               ->get();

        $ticket = DB::table('ticketclients')->where('id', $id)->first();

        return view('client.detailleticket', compact('messages', 'ticket'));
    }

    public function repondreTicket($id){
        $messages = DB::table('messageclients')->where('ticket_id', $id)
               ->orderBy('created_at', 'desc')
               ->get();

        $ticket = DB::table('ticketclients')->where('id', $id)->first();

        return view('client.detailleticket', compact('messages', 'ticket'));
    }


}
