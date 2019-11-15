<?php

namespace App\Services\Category;

use App\Interfaces\Entity\CategoryInterface;
use App\Interfaces\Repository\CategoryRepositoryInterface;
use App\ValueObject\CategoryId;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Show
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
     * @return CategoryInterface
     *
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function __invoke(CategoryId $id): CategoryInterface
    {
        $category = $this->categoryRepository->find($id);
        if ($category === null) {
            abort(404);
        }
        return $category;
    }
}