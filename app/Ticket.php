<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $casts = [
		'utilisateur_send' => 'int',
        'utilisateur_rece' => 'int',
        'commmande_id' => 'int',
        'produit_id' => 'int'
	];

	protected $fillable = [
		'utilisateur_send',
		'utilisateur_rece',
		'titre',
		'objet',
        'priorite',
        'support',
        'commande_id',
        'produit_id'
	];

    public function messages()
	{
		return $this->hasMany(Message::class, 'ticket_id');
	}

    public function demendeur()
    {
        return $this->belongsTo(UtilisateurPro::class, 'utilisateur_send');
    }

    public function recepteur()
    {
        return $this->belongsTo(UtilisateurPro::class, 'utilisateur_rece');
    }
}
