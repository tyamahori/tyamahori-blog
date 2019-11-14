<?php


namespace App\Services\Post;


use App\Interfaces\Repository\PostRepositoryInterface;
use App\ValueObject\PostId;

class Delete
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

    public function __invoke(PostId $id)
    {
        /**
         * 削除するエンティティを取得する
         */
        $deletePostEntity = $this->postRepository->find($id);
        if ($deletePostEntity === null) {
            abort(404);
        }

        $deletePostEntity->delete();
    }
}