<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versioning extends Model
{
      protected $fillable = ['project_id', 'version_number', 'changelog', 'status', 'release_date'];

      public function project()
      {
            return $this->belongsTo(Project::class, 'project_id');
      }

      public function users()
      {
            return $this->belongsToMany(User::class, 'user_versioning');
      }

}
