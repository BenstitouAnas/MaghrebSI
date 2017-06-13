<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use DB;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\LigneCommande;

class CommandeController extends Controller
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


    public function showCommandes(){
        return view('prestataire.commandes');
    }


    public function Commandes(){
        return Datatables::of(DB::table('commandes')->select('id','client_id','precision', 'montantTotalHT', 'created_at', 'etat')->get())
          ->addColumn('action', '<button type="button" id="InfosCommande" ref="{{$id}}" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>')
          ->rawColumns(['action'])
          ->make(true);
    }

    public function getCommandeByID($id){
        $commande = LigneCommande::where('commande_id', $id)->get();
        //return response()->json(DB::table('lignecommandes')->where('commande_id', $id)->first());
        return Response::json($commande);

        //$cmd = LigneCommande::where("commande_id", $id)->lists('produit_id', 'qte');
        //return response()->json(['success' => true, 'employees' => $cmd]);
    }
}
