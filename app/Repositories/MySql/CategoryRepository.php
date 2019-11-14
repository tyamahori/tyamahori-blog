<?php

namespace App\Repositories\MySql;

use App\Eloquent\CategoryOrm;
use App\Entities\CategoryEntity;
use App\Interfaces\Entity\CategoryInterface;
use App\Interfaces\Entity\TagInterface;
use App\Interfaces\Repository\CategoryRepositoryInterface;
use App\ValueObject\CategoryId;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * 全てのカテゴリをにmapしcollectionで返す
     * @return Collection
     */
    public function list(): Collection
    {
        return CategoryOrm::all()
            ->map(static function (CategoryOrm $categoryOrm) {
                return new CategoryEntity($categoryOrm);
            });
    }

    /**
     * タグを引数で取得する
     * @param CategoryId $id
     * @return TagInterface|null
     */
    public function find(CategoryId $id): ?CategoryInterface
    {
        // TODO: Implement find() method.
    }
}