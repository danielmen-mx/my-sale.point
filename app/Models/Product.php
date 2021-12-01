<?php

namespace App\Models;

// use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    // use Sluggable;

    protected $fillable = [
        'name',
        'brand',
        'description',
        'image',
        'sale_price',
        'acquisition_price',
        'user_id',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExcerptAttribute()
    {
        return substr($this->body, 0, 140);
    }

    public function getGetExcerptAttribute(){
        return Str::limit($this->body,140);
    }

    public function getGetImageAttribute(){
        if($this->image)
            return url("storage/$this->image");
    }
}
