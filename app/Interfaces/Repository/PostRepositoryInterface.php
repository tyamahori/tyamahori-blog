<?php

namespace App\Interfaces\Repository;

use App\Interfaces\Entity\PostInterface;
use App\ValueObject\PostId;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    /**
     * 投稿一覧を取得する
     * @return Collection
     */
    public function list(): Collection;

    /**
     * 投稿データを引数で取得する
     * @param PostId $id
     * @return PostInterface|null
     */
    public function find(PostId $id): ?PostInterface;

    /**
     * 新規登録処理
     * @param array $record
     * @return PostInterface
     */
    public function new(array $record): PostInterface;

    /**
     * 投稿の永続化処理
     * @param PostInterface $postEntity
     * @return PostInterface
     */
    public function persist(PostInterface $postEntity): PostInterface;

    /**
     * ひもづくデータを登録する処理
     * @param PostInterface $postEntity
     * @param array $inputData
     * @return PostInterface
     */
    public function sync(PostInterface $postEntity, array $inputData): PostInterface;
}