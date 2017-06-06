<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacite extends Model
{
  public function roles()
  {
      return $this->belongsToMany(Role::class);
  }
}
