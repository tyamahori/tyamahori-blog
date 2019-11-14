<?php

namespace App\Services\Tag;

use App\Interfaces\Repository\TagRepositoryInterface;
use Illuminate\Support\Collection;

class Lists
{
    private $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * タグをcollectionで取得する
     * @return Collection
     */
    public function __invoke()
    {
        return $this->tagRepository->list();
    }

}