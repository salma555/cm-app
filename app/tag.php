<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\posts;
class tag extends Model
{
    protected $fillable =['name'];
    public function posts(){
        return $this->belongsToMany(posts::class);
    }
}
