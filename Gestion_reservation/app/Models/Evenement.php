<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = [
        "libelle",
        "date_limite_inscription",
        "image_mise_en_avant",
        "est_cloturer_ou_pas",
        "date_evenement",
    ];
    public function association(){
        return $this->belongsTo(Association::class);
    }
    public function clients(){
        return $this->hasMany(Client::class);
    }
}
