<?php

namespace App\Repositories\MySql;

use App\Eloquent\PostOrm;
use App\Entities\PostEntity;
use App\Exceptions\ValueObjectError;
use App\Interfaces\Entity\PostInterface;
use App\Interfaces\Repository\PostRepositoryInterface;
use App\ValueObject\CategoryId;
use App\ValueObject\PostContent;
use App\ValueObject\PostDescription;
use App\ValueObject\PostId;
use App\ValueObject\PostIsPublic;
use App\ValueObject\PostTitle;
use Illuminate\Support\Collection;

class PostRepository implements PostRepositoryInterface
{
    /**
     * 全ての投稿をPostEntityにmapしcollectionで返す
     * @return Collection
     */
    public function list(): Collection
    {
        return PostOrm::all()
            ->map(static function (PostOrm $postOrm) {
                return new PostEntity($postOrm);
            });
    }

    /**
     * 特定の投稿を取得するメソッド
     * @param PostId $id
     * @return PostInterface|null
     */
    public function find(PostId $id): ?PostInterface
    {
        $post = PostOrm::find($id->getValue());
        if ($post === null) {
            return null;
        }

        return new PostEntity($post);
    }

    /**
     * 投稿の永続化処理
     * @param PostInterface $postEntity
     * @return PostInterface
     */
    public function persist(PostInterface $postEntity): PostInterface
    {
        $postEntity->getPostOrm()->save();
        return $postEntity;
    }

    /**
     * 新規登録処理
     * @param array $inputData
     * @return PostInterface
     * @throws ValueObjectError
     */
    public function new(array $inputData): PostInterface
    {
        return new PostEntity((new PostOrm())->forceFill([
            PostOrm::getTitleColumn()       => PostTitle::of($inputData['title'])->getValue(),
            PostOrm::getDescriptionColumn() => PostDescription::of($inputData['description'])->getValue(),
            PostOrm::getBodyColumn()        => PostContent::of($inputData['body'])->getValue(),
            PostOrm::getCategoryColumn()    => CategoryId::of($inputData['category_id'])->getValue(),
            PostOrm::getPublishedColumn()   => PostIsPublic::of($inputData['published'])->getValue(),
        ]));
    }

    /**
     * ひもづくデータを登録する処理
     * @param PostInterface $postEntity
     * @param array $inputData
     * @return PostInterface
     */
    public function sync(PostInterface $postEntity, array $inputData): PostInterface
    {
        // TODO 配列管理のValueObjectを使ってやる
        $postEntity->syncTags($inputData['tags']);
        return $postEntity;
    }
}