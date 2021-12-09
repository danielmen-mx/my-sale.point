<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total'
    ];


    public function descriptions()
    {
        return $this->hasMany(SaleDescription::class, "sale_id", "id");
    }

    public function costumerRelation()
    {
        return $this->belongsTo(Costumer::class, "costumer_id", "id");
    }

    public function seller()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}