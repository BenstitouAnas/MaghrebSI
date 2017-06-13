<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $casts = [
		'ticket_id' => 'int'
	];

	protected $fillable = [
		'ticket_id',
		'message'
	];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

}
