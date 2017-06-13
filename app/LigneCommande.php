<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    protected $table = 'lignecommandes';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $casts = [
		'commande_id' => 'int',
        'produit_id' => 'int',
        'sous_produit' => 'int',
        'qte' => 'int'
	];

	protected $fillable = [
		'commande_id',
		'produit_id',
		'sous_produit',
		'qte'
	];

    /*public function demendeur()
    {
        return $this->belongsTo(UtilisateurPro::class, 'utilisateur_id');
    }*/
}
