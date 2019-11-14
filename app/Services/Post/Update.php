<?php

namespace App\Services\Post;

use App\Interfaces\Repository\PostRepositoryInterface;
use App\ValueObject\CategoryId;
use App\ValueObject\PostContent;
use App\ValueObject\PostDescription;
use App\ValueObject\PostId;
use App\ValueObject\PostIsPublic;
use App\ValueObject\PostTitle;

class Update
{
    private $postRepository;

    /**
     * Lists constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(array $record)
    {
        /**
         * 入力データの整形
         */
        $inputData = [
            'id'          => $record['id'],
            'title'       => $record['title'],
            'description' => $record['description'],
            'category_id' => $record['category_id'],
            'tags'        => $record['tags'],
            'body'        => $record['post'],
            'published'   => $record['published'],
        ];

        /**
         * 更新するべきエンティティの取得
         */
        $currentPostEntity = $this->postRepository->find(PostId::of($inputData['id']));
        if ($currentPostEntity === null) {
            abort(404);
        }

        /**
         * 値を格納する
         */
        $currentPostEntity->setTitle(PostTitle::of($inputData['title']));
        $currentPostEntity->setDescription(PostDescription::of($inputData['description']));
        $currentPostEntity->setBody(PostContent::of($inputData['body']));
        $currentPostEntity->setCategoryId(CategoryId::of($inputData['category_id']));
        $currentPostEntity->setPublished(PostIsPublic::of($inputData['published']));

        /**
         * 新規データの永続
         */
        $updatedPostEntity = $this->postRepository->persist($currentPostEntity);

        /**
         * 投稿にひもづくタグの紐付け
         */
        $this->postRepository->sync($updatedPostEntity, $inputData);
    }
}