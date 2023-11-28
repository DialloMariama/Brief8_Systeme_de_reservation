<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        "nom",
        "slogan",
        "logo",
        "date_creation",
        "email",
        "password",

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function evenements(){
        return $this->hasMany(Evenement::class);
    }
}
