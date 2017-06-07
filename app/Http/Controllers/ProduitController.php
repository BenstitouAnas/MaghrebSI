<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;

use App\Produit;
use App\Categorie;
use Yajra\Datatables\Datatables;
use DB;
use DateTime;

use Mail;
use App\UtilisateurPro;
use App\User;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProduitController extends Controller
{
    public function showFormAjout()
    {
        $categories = DB::table('categories')->get();
        return view('prestataire.ajoutproduit', compact('categories'));
    }

    public function ajouterArticle(Request $req)
    {
        DB::table('produits')->insert(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 0, 'categorie_id' => $req->categorie_id,
        'prix' => $req->prix, 'qte' => $req->qte, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        //return 'Produit : '.$req->libelle.', bien ajouté !';

        Session::flash('message', 'Produit créer avec succès !');
        return Redirect::to('/Prestataires/Produits');
    }

    public function ajouterBooking(Request $req)
    {
        DB::table('produits')->insert(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 1, 'categorie_id' => $req->categorie_id,
        'prix' => $req->prix, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        return 'Produit : '.$req->libelle.', bien ajouté !';
    }

    public function ajouterDeal(Request $req)
    {
        DB::table('produits')->insert(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 2, 'categorie_id' => $req->categorie_id,
        'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        return 'Produit : '.$req->libelle.', bien ajouté !';
    }

    public function ajouterPrestation(Request $req)
    {
        DB::table('produits')->insert(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 3, 'categorie_id' => $req->categorie_id,
        'prix' => $req->prix, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        return 'Produit : '.$req->libelle.', bien ajouté !';
    }


    public function showProduits(){
        //$categories = DB::table('categories')->get();

        return view('prestataire.produits');
    }


    public function Produits(){
        return Datatables::of(DB::table('produits')->select('produits.id','libelle','image','typeProduit','documentation','prix', 'qte', 'titre')
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->get())
            ->addColumn('action', '<button type="button" id="InfosPrestataire" ref="{{$id}}" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>')
            ->addColumn('typeProduit', function($cc){
                if ($cc->typeProduit == '0') return '<span class="label label-success">Article e-commerce</span>';
                if ($cc->typeProduit == '1') return '<span class="label label-info">Booking</span>';
                if ($cc->typeProduit == '2') return '<span class="label label-danger">Deal</span>';
                if ($cc->typeProduit == '3') return '<span class="label label-danger">Préstation</span>';
            })
            ->editColumn('categorie',function($cl) {
                    $ff = DB::table('categories')->where("titre",$cl->titre)->first();
                    return $ff->titre;
                })
            ->addColumn('documentation',function($cll) {
                    $pr = DB::table('produits')->where("id", $cll->id)->first();
                    return '<a href="'.$pr->documentation.'" target="_blank"><button type="button" id="" value="'.$pr->documentation.'" class="btn btn-group-vertical btn-block">
                        <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
                    </button></a>';
                })
            ->rawColumns(['action', 'typeProduit', 'documentation'])
            ->make(true);
    }
}
