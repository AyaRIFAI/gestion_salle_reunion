<?php

namespace App\Models;

use App\Models\User;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prof extends Model
{
    use HasFactory;
    protected $fillable=['lastName', 'firstName', 'Tel', 'path_image', 'email', 'departement_id', 'user_id'];
    public function departement(){
        return $this->belongsTo(Departement::class);
    } 
    public function user(){
        return $this->belongsTo(User::class);
    } 
}
