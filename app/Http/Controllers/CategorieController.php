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

class CategorieController extends Controller
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


    public function showCategories(){
        return view('prestataire.categories');
    }


    public function Categories(){
        return Datatables::of(DB::table('categories')->select('id','titre','description')->where('utilisateur_id', Auth::user()->getAuthIdentifier())->get())
          ->addColumn('action', '<button type="button" id="Del_Categorie" ref="{{$id}}" class="btn btn-link"><i class="icon-cross2"></i></button>&nbsp;&nbsp;<button type="button" id="Edit_Categorie" ref="{{$id}}" class="btn btn-link"><i class="icon-pencil7"></i></button>')
          ->rawColumns(['action'])
          ->make(true);
    }

    public function addCategorie(Request $req){
        DB::table('categories')->insert(['titre' => $req->titre,'description' => $req->description, 'utilisateur_id' => Auth::user()->getAuthIdentifier(), 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        return 'Catégorie : '.$req->titre.', bien ajoutée !';

    }

    public function deleteCategorie(Request $req){
        $titre = DB::table('categories')->where('id', $req->id)->first();
        DB::table('categories')->where('id', $req->id)->delete();
        return 'Catégorie : '.$titre->titre.', bien supprimée !';
    }

    public function getCategorieByID($id){
        return response()->json(DB::table('categories')->where('id', $id)->first());
    }

    public function updateCategorie(Request $req){
        $titre = DB::table('categories')->where('id', $req->id)->first();
        DB::table('categories')
            ->where('id', $req->id)
            ->update(['titre' => $req->titre,'description' => $req->description]);
        return 'Catégorie : '.$titre->titre.', bien modifiée !';
    }
}
