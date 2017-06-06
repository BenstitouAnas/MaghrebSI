<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;
use App\Role;
use App\Capacite;
use Yajra\Datatables\Datatables;
use DB;
use DateTime;

use Mail;
use App\UtilisateurPro;
use App\User;


class CommercialeController extends Controller
{
    public function showCommerciales(){
        $roles = DB::table('roles')->get();
        $superieurs = DB::table('utilisateurpros')->select('utilisateurpros.id','nom','prenom')->where('typeUser', '=', 1)->get();

        return view('admin.commerciales', compact('roles', 'superieurs'));
    }

    public function Commerciales(){
        return Datatables::of(DB::table('utilisateurpros')->select('utilisateurpros.id','nom','prenom','email','etat','role')
            ->join('roles', function ($join) {
                $join->on('utilisateurpros.role_id', '=', 'roles.id')
                    ->where('utilisateurpros.typeUser', '=', 1)->where('etat', '<>', 'Attente');
            })
            ->get())
            ->addColumn('action', '<button type="button" id="InfosCommerciale" ref="{{$id}}" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>')
            ->addColumn('etat', function($cc){
                if ($cc->etat == 'Confirme') return '<span class="label label-success">Confirmé</span>';
                if ($cc->etat == 'Attente') return '<span class="label label-info">En Attente</span>';
                if ($cc->etat == 'Suspendue') return '<span class="label label-danger">Suspendue</span>';
                else return '<span class="label label-default">Autre</span>';
            })
            ->editColumn('role',function($cl) {
                    $ff = DB::table('roles')->where("role",$cl->role)->first();
                    return $ff->role;
                })
            ->rawColumns(['action', 'etat'])
            ->make(true);
    }

    public function addCommerciale(Request $req){

        DB::table('utilisateurpros')
            ->insert(['nom' => $req->nom, 'prenom' => $req->prenom, 'email' => $req->email, 'identifiantLegale' => $req->identifiantLegale,
            'compagnie' => $req->compagnie, 'role_id' => $req->role_id, 'statusEntreprise' => $req->statusEntreprise, 'etat' => 'Attente',
            'superieur' => $req->superieur,'tel' => $req->tel, 'typeUser' => 1,'password' => 'NotDefined', 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);

        return 'Commerciale : '.$req->nom.' '.$req->prenom.', bien ajouté !';
    }


    public function CommercialeSendEmail(Request $req){   

        $pw = User::generatePassword();

        $user = new UtilisateurPro;

        $user->email = $req->email;
        $user->password = $pw;

        User::sendWelcomeEmail($user);
    }
    

    public function getCommercialeByID($id){
        return response()->json(DB::table('utilisateurpros')->where('id', $id)->first());
    }

    public function updateCommerciale(Request $req){
        $commerciale = DB::table('utilisateurpros')->where('id', $req->id)->first();
        DB::table('utilisateurpros')
            ->where('id', $req->id)
            ->update(['nom' => $req->nom, 'prenom' => $req->prenom, 'email' => $req->email, 'identifiantLegale' => $req->identifiantLegale,
            'compagnie' => $req->compagnie, 'role_id' => $req->role_id, 'statusEntreprise' => $req->statusEntreprise, 'etat' => $req->etat,
            'superieur' => $req->superieur,'tel' => $req->tel]);

        return 'Commerciale : '.$commerciale->nom.' '.$commerciale->prenom.', bien modifié !';
    }



    public function showDemandesCommerciales(){
        $roles = DB::table('roles')->get();
        $superieurs = DB::table('utilisateurpros')->select('utilisateurpros.id','nom','prenom')->where('typeUser', '=', 1)->get();

        return view('admin.demandes', compact('roles', 'superieurs'));
    }


    public function Demandes(){
        return Datatables::of(DB::table('utilisateurpros')->select('utilisateurpros.id','nom','prenom','email','etat','role')
            ->join('roles', function ($join) {
                $join->on('utilisateurpros.role_id', '=', 'roles.id')
                    ->where('utilisateurpros.typeUser', '=', 1)->where('etat', '=', 'Attente');
            })
            ->get())
            ->addColumn('action', '<button type="button" id="InfosCommerciale" ref="{{$id}}" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>')
            ->addColumn('etat',
                              '<form><select name="etatChange" class="form-control" ref="{{$id}}" id="selectEtatChange" class="selectChange">
                                        <option></option>
                                        <option value="Confirme">Confirmé</option>
                                        <option value="Suspendue">Suspendue</option>
                                    </select></form>'
            )
            ->editColumn('role',function($cl) {
                    $ff = DB::table('roles')->where("role",$cl->role)->first();
                    return $ff->role;
                })
            ->rawColumns(['action', 'etat'])
            ->make(true);
    }

    public function CommercialeConfirme(Request $req){
        $commerciale = DB::table('utilisateurpros')->where('id', $req->id)->first();
        DB::table('utilisateurpros')
            ->where('id', $req->id)
            ->update(['etat' => $req->etat]);

        return 'Commerciale : '.$commerciale->nom.' '.$commerciale->prenom.', bien confirmé !';
    }

}
