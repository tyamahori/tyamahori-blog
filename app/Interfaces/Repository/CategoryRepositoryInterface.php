<?php

namespace App\Interfaces\Repository;

use App\Interfaces\Entity\CategoryInterface;
use App\Interfaces\Entity\TagInterface;
use App\ValueObject\CategoryId;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    /**
     * タグ一覧を取得する
     * @return Collection
     */
    public function list(): Collection;

    /**
     * タグを引数で取得する
     * @param CategoryId $id
     * @return TagInterface|null
     */
    public function find(CategoryId $id): ?CategoryInterface;
}