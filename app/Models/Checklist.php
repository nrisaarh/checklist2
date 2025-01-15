<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = ['year', 'month','item', 'pic', 'status', 'note', 'checked'];
    public function picRelation()
    {
        return $this->belongsTo(Pic::class, 'pic', 'name');
    }
}
