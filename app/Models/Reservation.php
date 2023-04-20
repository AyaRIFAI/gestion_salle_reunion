<?php

namespace App\Models;

use App\Models\Salle;
use App\Models\Reunion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable=['motif', 'salle_id', 'reunion_id', 'prof_id', 'state'];
    public function salle(){
        return $this->belongsTo(Salle::class);
    }
    public function reunion(){
        return $this->belongsTo(Reunion::class);
    }
    public function prof(){
        return $this->belongsTo(Prof::class);
    }
}
