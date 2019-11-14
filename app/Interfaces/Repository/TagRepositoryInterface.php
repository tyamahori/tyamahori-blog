<?php

namespace App\Interfaces\Repository;

use App\Interfaces\Entity\TagInterface;
use App\ValueObject\TagId;
use Illuminate\Support\Collection;

interface TagRepositoryInterface
{
    /**
     * タグ一覧を取得する
     * @return Collection
     */
    public function list(): Collection;

    /**
     * タグを引数で取得する
     * @param TagId $id
     * @return TagInterface|null
     */
    public function find(TagId $id): ?TagInterface;
}