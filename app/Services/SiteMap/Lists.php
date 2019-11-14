<?php

namespace App\Services\SiteMap;

use App\Entities\PostEntity;
use App\Interfaces\Repository\PostRepositoryInterface;
use Illuminate\Support\Collection;

class Lists
{
    /**
     * @var PostRepositoryInterface
     */
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
     * 公開されている投稿を全て取得する
     * @return Collection
     */
    public function __invoke()
    {
        return $this->postRepository->list()->filter(static function (PostEntity $postEntity) {
            return $postEntity->isPublic()->getValue();
        });
    }
}