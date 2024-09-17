<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    public function matches()
    {
        return $this->hasMany(Matches::class, 'competition_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
