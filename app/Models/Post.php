<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'body',
        'iframe',
        'image',
        'user_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

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
        if($this->image)    // the conditional say, if the post had a image
            return url("storage/$this->image");      // return the view from the directory

        //  the image doesn't send to the view, because we try to show an image that y archived in a private storage, so is hidden, we need to create an access directly to send the image to the index

        // we use the cmd comand "php artisan storage:link"
    }
}
