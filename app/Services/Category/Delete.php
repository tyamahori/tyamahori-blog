<?php

namespace App\Services\Category;

use App\Interfaces\Repository\CategoryRepositoryInterface;
use App\ValueObject\CategoryId;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Delete
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * Lists constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryId $id
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function __invoke(CategoryId $id)
    {
        /**
         * 削除するエンティティを取得する
         */
        $deleteCategoryEntity = $this->categoryRepository->find($id);
        if ($deleteCategoryEntity === null) {
            abort(404);
        }

        $deleteCategoryEntity->delete();
    }
}