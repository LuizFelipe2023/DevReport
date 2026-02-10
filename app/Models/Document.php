<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['versioning_id', 'original_name', 'file_path', 'file_ext'];

    public function versioning()
    {
        return $this->belongsTo(Versioning::class);
    }
}
