<?php

namespace App\Models;

use App\Models\Prof;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;
    protected $fillable=['name', 'sigle'];
    public function profs(){
        return $this->hasMany(Prof::class);
    }
}
