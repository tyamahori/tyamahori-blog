<?php

namespace App\Services\Post;

use App\Interfaces\Repository\PostRepositoryInterface;

class Add
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
            'title'       => $record['title'],
            'description' => $record['description'],
            'category_id' => $record['category_id'],
            'tags'        => $record['tags'],
            'body'        => $record['post'],
            'published'   => $record['published'],
        ];

        /**
         * 新規データを格納
         */
        $newPostEntity = $this->postRepository->new($inputData);

        /**
         * 新規データの永続
         */
        $createdPostEntity = $this->postRepository->persist($newPostEntity);

        /**
         * 投稿にひもづくタグの紐付け
         */
        $this->postRepository->sync($createdPostEntity, $inputData);
    }
}