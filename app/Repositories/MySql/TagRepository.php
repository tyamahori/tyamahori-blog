<?php

namespace App\Repositories\MySql;

use App\Eloquent\TagOrm;
use App\Entities\TagEntity;
use App\Interfaces\Entity\TagInterface;
use App\Interfaces\Repository\TagRepositoryInterface;
use App\ValueObject\TagId;
use Illuminate\Support\Collection;

class TagRepository implements TagRepositoryInterface
{
    /**
     * 全ての投稿をPostEntityにmapしcollectionで返す
     * @return Collection
     */
    public function list(): Collection
    {
        return TagOrm::all()
            ->map(static function (TagOrm $tagOrm) {
                return new TagEntity($tagOrm);
            });
    }

    /**
     * タグを引数で取得する
     * @param TagId $id
     * @return TagInterface|null
     */
    public function find(TagId $id): ?TagInterface
    {
        // TODO: Implement find() method.
    }
}