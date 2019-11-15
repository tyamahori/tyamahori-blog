<?php

namespace App\Repositories\MySql;

use App\Eloquent\CategoryOrm;
use App\Entities\CategoryEntity;
use App\Exceptions\ValueObjectError;
use App\Interfaces\Entity\CategoryInterface;
use App\Interfaces\Entity\TagInterface;
use App\Interfaces\Repository\CategoryRepositoryInterface;
use App\ValueObject\CategoryId;
use App\ValueObject\CategoryName;
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
        $category = CategoryOrm::find($id->getValue());
        if ($category === null) {
            return null;
        }
        return new CategoryEntity($category);
    }

    /**
     * カテゴリの新規登録
     * @param array $record
     * @return CategoryInterface
     * @throws ValueObjectError
     */
    public function new(array $record): CategoryInterface
    {
        return new CategoryEntity((new CategoryOrm())->forceFill([
            CategoryOrm::getNameColumn() => CategoryName::of($record['category'])->getValue()
        ]));
    }

    /**
     * カテゴリの永続化
     * @param CategoryInterface $categoryEntity
     * @return CategoryInterface
     */
    public function persist(CategoryInterface $categoryEntity): CategoryInterface
    {
        $categoryEntity->getCategoryOrm()->save();
        return $categoryEntity;
    }
}