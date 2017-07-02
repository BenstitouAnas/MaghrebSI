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


class PrestataireController extends Controller
{
    public function showPrestataires(){
        $roles = DB::table('roles')->get();
        //$superieurs = DB::table('utilisateurpros')->select('utilisateurpros.id','nom','prenom')->get();

        return view('admin.prestataires', compact('roles'));
    }

    public function Prestataires(){
        return Datatables::of(DB::table('utilisateurpros')->select('utilisateurpros.id','nom','prenom','email','etat','role')
            ->join('roles', function ($join) {
                $join->on('utilisateurpros.role_id', '=', 'roles.id')
                    ->where('utilisateurpros.typeUser', '=', 2);
            })
            ->get())
            ->addColumn('action', '<button type="button" id="InfosPrestataire" ref="{{$id}}" class="btn btn-default"><i class="icon-plus2 position-left"></i> Infos</button>')
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

    public function addPrestataire(Request $req){

        DB::table('utilisateurpros')
            ->insert(['nom' => $req->nom, 'prenom' => $req->prenom, 'email' => $req->email, 'identifiantLegale' => $req->identifiantLegale,
            'compagnie' => $req->compagnie, 'role_id' => $req->role_id, 'statusEntreprise' => $req->statusEntreprise, 'etat' => 'Confirme',
            'tel' => $req->tel, 'typeUser' => 2,'password' => 'NotDefined', 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);


        return 'Prestataire : '.$req->nom.' '.$req->prenom.', bien ajouté !';
    }


    public function PrestataireSendEmail(Request $req){   

        $pw = User::generatePassword();

        $user = new UtilisateurPro;

        $user->email = $req->email;
        $user->password = $pw;

        User::sendWelcomeEmail($user);
        
        /*Mail::send('emails.welcome', ['user' => $user, 'token' => $token], function ($m) use ($user) {
            $m->from('hello@appsite.com', 'Your App Name');
            $m->to($user->email, $user->name)->subject('Welcome to APP');
        });


        Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
        {
            $message->subject('Modification de ');
            $message->from('MaghrebSI-TestMail@maghrebsi.com', 'Maghreb-SI');
            $message->to('anasben2013@gmail.com');
        });*/

        //return $req->emailTest;
    }
    

    public function getPrestataireByID($id){
        return response()->json(DB::table('utilisateurpros')->where('id', $id)->first());
    }

    public function updatePrestataire(Request $req){
        $prestataire = DB::table('utilisateurpros')->where('id', $req->id)->first();
        DB::table('utilisateurpros')
            ->where('id', $req->id)
            ->update(['nom' => $req->nom, 'prenom' => $req->prenom, 'email' => $req->email, 'identifiantLegale' => $req->identifiantLegale,
            'compagnie' => $req->compagnie, 'role_id' => $req->role_id, 'statusEntreprise' => $req->statusEntreprise, 'etat' => $req->etat,
            'tel' => $req->tel, 'updated_at' => new DateTime()]);

        return 'Pestataire : '.$prestataire->nom.' '.$prestataire->prenom.', bien modifié !';
    }

}
