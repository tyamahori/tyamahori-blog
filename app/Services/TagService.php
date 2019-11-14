<?php

namespace App\Services;

use App\Repositories\Interfaces\TagRepositoryInterface;

class TagService
{
    public function __construct(TagRepositoryInterface $tag_repository)
    {
        $this->tag_repository = $tag_repository;
    }

    public function getAllTags()
    {
        return $this->tag_repository->getAllTags();
    }
}
