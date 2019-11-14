<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'post',
        'published',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsto('App\Models\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'post_tag', 'post_id', 'tag_id');
    }

    public function scopepublishedposts($query)
    {
        return $query->where('published', '=', 1);
    }

    public function scopepublishedpost($query, $id)
    {
        return $query->where('published', 1)->where('id', $id);
    }
}
