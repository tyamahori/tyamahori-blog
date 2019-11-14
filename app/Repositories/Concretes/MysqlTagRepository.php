<?php

namespace App\Repositories\Concretes;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class MysqlTagRepository implements TagRepositoryInterface
{
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function getAllTags()
    {
        return $this->tag->all();
    }
}
