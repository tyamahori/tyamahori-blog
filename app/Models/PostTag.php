<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostTag extends Model
{
    use SoftDeletes;

    protected $table = 'post_tag';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
}
