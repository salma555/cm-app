<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\posts;

class category extends Model
{
  protected $fillable =['name'];

  public function posts(){
    return $this->hasMany(posts::class);
  }
}
