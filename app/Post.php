<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
    use softDeletes;

    protected $fillable = [
        'title' , 'content' , 'featured' , 'category_id' , 'slug'
    ];

    protected $dates = ['deleted_at'];

    public function getFeaturedAttribute($featured)
    {
        return asset($featured);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}