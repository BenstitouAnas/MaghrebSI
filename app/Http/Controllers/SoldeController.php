<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\UtilisateurPro;
use App\User;
use App\Retrait;

class SoldeController extends Controller
{
    public function DemandesRetrait(){
        $retraits = UtilisateurPro::find(auth::user()->getAuthIdentifier())->retraits;

        return view('commerciale.demanderetrait', compact('retraits'));
    }

    public function DemanderRetrait(Request $req){
        /*$this->validate($request, [
            'montant' => 'numeric|required',
            'facture' => 'required|mimes:pdf',
        ]);
        $monnaie=Monnaie::firstOrNew(array('devise' => $request['devise'],
            'val' => $request['montant']));
        $monnaie->save();*/
        $retrait=new Retrait();
        $retrait->montant=$req->montant;
        $retrait->facture=$req->facture;
        $retrait->etat="envoye";
        $retrait->utilisateur_id=Auth::user()->getAuthIdentifier();
        //if($request->hasFile('facture')) $this->enregistrerFacture($request,$retrait);
        $retrait->save();
        //Session::flash('message', 'Demande de retrait envoyer avec succès !');


        //DB::table('retraits')->insert(['etat' => 'envoye','montant' => $req->montant, 'facture' => $req->facture, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        return 'Demande bien envoyée !';
        //return Redirect::to('/Commerciales');
    }
}
