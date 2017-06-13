<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $casts = [
		'utilisateur_id' => 'int'
	];

	protected $fillable = [
		'evaluation',
		'montant',
		'motif',
		'utilisateur_id'
	];

    public function demendeur()
    {
        return $this->belongsTo(UtilisateurPro::class, 'utilisateur_id');
    }
}
