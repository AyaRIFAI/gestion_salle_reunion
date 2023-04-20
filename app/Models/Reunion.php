<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;
    protected $fillable=['reunion_date', 'beginning_hour', 'finish_reunion_hour', 'salle_id'];
    public function reservation(){
        return $this->hasOne(Reservation::class);
    } 
}
