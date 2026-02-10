<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
      protected $fillable = ['name'];

      public function projects()
      {
             return $this->hasMany(Project::class);
      }

      public function versionings()
      {
             return $this->hasMany(Versioning::class);
      }
}
