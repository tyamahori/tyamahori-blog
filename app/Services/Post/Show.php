<?php

namespace App\Services\Post;

use App\Interfaces\Entity\PostInterface;
use App\Interfaces\Repository\PostRepositoryInterface;
use App\ValueObject\PostId;

class Show
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

    /**
     * 投稿を1つ取得する。管理画面側
     * @param PostId $id
     * @return PostInterface|null
     */
    public function showAdmin(PostId $id): ?PostInterface
    {
        $post = $this->postRepository->find($id);

        if ($post === null) {
            abort(404);
        }

        return $post;
    }

    /**
     * 一般ユーザー向けのメソッド
     * @param PostId $id
     * @return PostInterface|null
     */
    public function showClient(PostId $id): ?PostInterface
    {
        $post = $this->postRepository->find($id);

        if ($post === null || !$post->isPublic()->getValue()) {
            abort(404);
        }

        return $post;
    }
}