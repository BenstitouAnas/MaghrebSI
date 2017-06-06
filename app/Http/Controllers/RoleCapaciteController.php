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

class RoleCapaciteController extends Controller
{
    public function listeRoles(){
        $states = DB::table("roles")->pluck("role","id");
        return view('admin.prestataires',compact('listeRoles'));
    }

    public function showRoles(){
        return view('admin.roles');
    }

    public function Roles(){
        return Datatables::of(DB::table('roles')->select('id','role','description')->get())
          ->addColumn('action', '<button type="button" id="Del_Role" ref="{{$id}}" class="btn btn-link"><i class="icon-cross2"></i></button>&nbsp;&nbsp;<button type="button" id="Edit_Role" ref="{{$id}}" class="btn btn-link"><i class="icon-pencil7"></i></button>')
          ->rawColumns(['action'])
          ->make(true);
    }

    public function addRole(Request $req){
        DB::table('roles')->insert(['role' => $req->role,'description' => $req->description, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        return 'Rôle : '.$req->role.', bien ajouté !';

    }

    public function deleteRole(Request $req){
        $role = DB::table('roles')->where('id', $req->id)->first();
        DB::table('roles')->where('id', $req->id)->delete();
        return 'Rôle : '.$role->role.', bien aupprimé !';
    }

    public function getRoleByID($id){
        return response()->json(DB::table('roles')->where('id', $id)->first());
    }

    public function updateRole(Request $req){
        $role = DB::table('roles')->where('id', $req->id)->first();
        DB::table('roles')
            ->where('id', $req->id)
            ->update(['role' => $req->role,'description' => $req->description]);
        return 'Rôle : '.$role->role.', bien modifié !';
    }

    //*************************************************************************************************
    
    public function showCapacites(){
        return view('admin.capacites');
    }

        public function Capacites(){
        return Datatables::of(DB::table('capacites')->select('id','capacite')->get())
          ->addColumn('action', '<button type="button" id="Del_Capacite" ref="{{$id}}" class="btn btn-link"><i class="icon-cross2"></i></button>&nbsp;&nbsp;<button type="button" id="Edit_Capacite" ref="{{$id}}" class="btn btn-link"><i class="icon-pencil7"></i></button>')
          ->rawColumns(['action'])
          ->make(true);
    }

    public function addCapacite(Request $req){
        DB::table('capacites')->insert(['capacite' => $req->capacite, 'created_at' => new DateTime(), 'updated_at' => new DateTime()]);
        return 'Capacitée : '.$req->capacite.', bien ajoutée !';
    }

    public function deleteCapacite(Request $req){
        $capacite = DB::table('capacites')->where('id', $req->id)->first();
        DB::table('capacites')->where('id', $req->id)->delete();
        return 'Capacitée : '.$capacite->capacite.', bien aupprimée !';
    }

    public function getCapaciteByID($id){
        return response()->json(DB::table('capacites')->where('id', $id)->first());
    }

    public function updateCapacite(Request $req){
        $capacite = DB::table('capacites')->where('id', $req->id)->first();
        DB::table('capacites')
            ->where('id', $req->id)
            ->update(['capacite' => $req->capacite]);
        return 'Capacitée : '.$capacite->capacite.', bien modifié !';
    }

}