<?php

namespace App\Services\Post;

use App\Interfaces\Repository\PostRepositoryInterface;
use App\ValueObject\PostIsPublic;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
     * ページネーションの対応
     * @param PostIsPublic $isPublic
     * @param int $postsPerPage
     * @return LengthAwarePaginator
     */
    public function __invoke(PostIsPublic $isPublic, int $postsPerPage): LengthAwarePaginator
    {
        // 全権取得
        $all = $this->postRepository->list();

        // 引数の条件に応じて公開分のみにするかを確認
        if ($isPublic->getValue()) {
            $all = $all->filter(static function ($postEntity) {
                return $postEntity->isPublic()->getValue();
            });
        }

        // 全部の件数をカウント
        $counts = $all->count();

        // 現在のページ番号を取得
        $currentPageNo = Paginator::resolveCurrentPage();

        // ページネートに必要な情報を取得する
        $chunks = $all->chunk($postsPerPage)[$currentPageNo - 1];

        // ページネートして返す
        return new LengthAwarePaginator($chunks, $counts, $postsPerPage, $currentPageNo);
    }
}