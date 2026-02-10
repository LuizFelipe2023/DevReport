<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
       protected $fillable = ['name','description','status_id','github_url'];

       public function status()
       {
              return $this->belongsTo(Status::class,'status_id');
       }

}
