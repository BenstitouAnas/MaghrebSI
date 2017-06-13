<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retrait extends Model
{
    protected $table = 'retraits';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $casts = [
		'utilisateur_id' => 'int'
	];

	protected $fillable = [
		'etat',
		'facture',
		'montant',
		'utilisateur_id'
	];

    public function demendeur()
    {
        return $this->belongsTo(UtilisateurPro::class, 'utilisateur_id');
    }
}
