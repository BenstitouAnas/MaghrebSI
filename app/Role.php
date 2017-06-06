<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $table = 'roles';

  public $fillable = ['role','description','created_at','updated_at'];

  public function capacites()
  {
      return $this->belongsToMany(Capacite::class)->withPivit('created_at');
  }
}
