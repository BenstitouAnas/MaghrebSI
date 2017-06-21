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
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
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

     public function Produits(){
        return Datatables::of(DB::table('produits')->select('produits.id','libelle','image','typeProduit','documentation','prix', 'qte', 'titre', 'categorie_id')
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->get())
            ->addColumn('action', function($tt){
                if( $tt->typeProduit == '0' ) return '<button type="button" id="InfoArticle" ref="'.$tt->id.'" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>';
                if( $tt->typeProduit == '1' ) return '<a href="../Prestataires/ProduitsByID/'. $tt->id .'"><button type="button" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button></a>';
                if( $tt->typeProduit == '2' ) return '<a href="../Prestataires/ProduitsByID/'. $tt->id .'"><button type="button" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button></a>';
                if( $tt->typeProduit == '3 ') return '<button type="button" id="InfoPrestataion" ref="'.$tt->id.'" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>';
            })
            //'<button type="button" id="InfosPrestataire" ref="{{$id}}" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>')
            ->addColumn('typeProduit', function($cc){
                if ($cc->typeProduit == '0') return '<span class="label label-success">Article e-commerce</span>';
                if ($cc->typeProduit == '1') return '<span class="label label-info">Booking</span>';
                if ($cc->typeProduit == '2') return '<span class="label label-danger">Deal</span>';
                if ($cc->typeProduit == '3') return '<span class="label label-warning">Préstation</span>';
            })
            ->addColumn('image', '<img src="{{url("assets/images/brands/amazon.png")}}" class="img-circle img-xs" alt="">'
                )
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
            ->rawColumns(['action', 'typeProduit', 'documentation', 'image'])
            ->make(true);
    }

    public function showFormAjout()
    {
        $categories = DB::table('categories')->where('utilisateur_id', Auth::user()->getAuthIdentifier())->get();
        return view('prestataire.ajoutproduit', compact('categories'));
    }

    public function ajouterArticle(Request $req)
    {
        $lastInsertedID = DB::table('produits')->insertGetId(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 0, 'categorie_id' => $req->categorie_id,
        'prix' => $req->prix, 'qte' => $req->qte, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);

        Session::flash('message', 'Produit créer avec succès !');
        return view('prestataire.produits');
    }

    public function ajouterBooking(Request $req)
    {
        $lastInsertedID = DB::table('produits')->insertGetId(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 1, 'categorie_id' => $req->categorie_id,
        'prix' => $req->prix, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        
        Session::flash('message', 'Produit créer avec succès !');
        return $lastInsertedID;
    }

    public function ajouterDeal(Request $req)
    {
        $lastInsertedID = DB::table('produits')->insertGetId(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 2, 'categorie_id' => $req->categorie_id,
        'created_at' => new DateTime(), 'updated_at' => new DateTime()]);

        Session::flash('message', 'Produit créer avec succès !');
        return $lastInsertedID;
    }

    public function ajouterPrestation(Request $req)
    {
        $lastInsertedID = DB::table('produits')->insertGetId(['libelle' => $req->libelle,'image' => $req->image, 'documentation' => $req->documentation,
        'documentationTechnique' => $req->documentationTechnique, 'typeProduit' => 3, 'categorie_id' => $req->categorie_id,
        'prix' => $req->prix, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        
        Session::flash('message', 'Produit créer avec succès !');
        return view('prestataire.produits');
    }


    public function showProduits(){
        //$categories = DB::table('categories')->get();

        return view('prestataire.produits');
    }


    public function getProduitByID($id){
        $produit = DB::table('produits')->where('id', $id)->first();
        $categories = DB::table('categories')->where('utilisateur_id', Auth::user()->getAuthIdentifier())->get();

        if ($produit->typeProduit == 0) return view('prestataire.produits');
        if ($produit->typeProduit == 1) return view('prestataire.booking', compact('produit', 'categories'));
        if ($produit->typeProduit == 2) return view('prestataire.deal', compact('produit', 'categories'));
        if ($produit->typeProduit == 3) return 'Prestation';
    }

    public function updateProduitDeal(Request $req){
        $produit = DB::table('produits')->where('id', $req->id)->first();
        DB::table('produits')
            ->where('id', $req->id)
            ->update(['libelle' => $req->libelle, 'documentationTechnique' => $req->documentationTechnique,
            'image' => $req->image, 'categorie_id' => $req->categorie, 'updated_at' => new DateTime()]);

        return 'Produit Deal : '.$produit->libelle.', bien modifié !';
    }

    public function dealAdd(Request $req)
    {
        $lastInsertedID = DB::table('deals')->insertGetId(['titre' => $req->titre,'prix' => $req->prix, 'nombrePlaces' => $req->nombrePlaces,
        'dateLimite' => $req->dateLimite, 'produit_id' => $req->produit_id, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        
        Session::flash('message', 'Deal créer avec succès !');
        return 'Deal : '.$req->titre.', bien ajouté !';
    }

    public function showDeals($id){
        return Datatables::of(DB::table('deals')->select('id','titre', 'prix', 'nombrePlaces', 'dateLimite')->where('produit_id', $id)->get())
          ->addColumn('action', '<button type="button" id="Del_Deal" ref="{{$id}}" class="btn btn-link"><i class="icon-cross2"></i></button>&nbsp;&nbsp;<button type="button" id="Edit_Deal" ref="{{$id}}" class="btn btn-link"><i class="icon-pencil7"></i></button>')
          ->rawColumns(['action'])
          ->make(true);
    }

    public function deleteDeal(Request $req){
        $titre = DB::table('deals')->where('id', $req->id)->first();
        DB::table('deals')->where('id', $req->id)->delete();
        return 'Deal : '.$titre->titre.', bien supprimé !';
    }

    public function getDealByID($id){
        return response()->json(DB::table('deals')->where('id', $id)->first());
    }

    public function updateDeal(Request $req){
        $titre = DB::table('deals')->where('id', $req->id)->first();
        DB::table('deals')
            ->where('id', $req->id)
            ->update(['titre' => $req->titre,'prix' => $req->prix, 'nombrePlaces' => $req->nombrePlaces, 'dateLimite' => $req->dateLimite,
            'updated_at' => new DateTime()]);
        return 'Deal : '.$titre->titre.', bien modifié !';
    }

    public function getArticlePrestataionByID($id){
        return response()->json(DB::table('produits')->where('id', $id)->first());
    }

    public function updateArticle(Request $req){
        $prestataire = DB::table('produits')->where('id', $req->id)->first();
        DB::table('produits')
            ->where('id', $req->id)
            ->update(['libelle' => $req->libelle, 'documentation' => $req->documentation, 'documentationTechnique' => $req->documentationTechnique,
            'categorie_id' => $req->categorie_id, 'updated_at' => new DateTime()]);

        return 'Péstataire : '.$prestataire->libelle.', bien modifié !';
    }

}
