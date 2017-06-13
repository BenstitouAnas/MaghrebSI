<?php

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class UtilisateurPro extends Authenticatable
{
    use Notifiable;

	protected $table = 'utilisateurpros';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nom', 'prenom', 'password', 'email', 'tel', 'adresse',
        'compagnie', 'identifiantLegale', 'statusEntreprise'
	];

    protected $hidden = [
        'password', 'remember_token',
    ];



    public function role(Request $request)
    {
        $utilisateur = DB::table('utilisateurpros')->select('*')->where('role_id',$request->id)->get();
        return view('', compact('utilisateurpros'));
    }

    public function retraits()
	{
		return $this->hasMany(Retrait::class, 'utilisateur_id');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'utilisateur_id');
	}
	
}
