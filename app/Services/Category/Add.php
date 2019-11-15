<?php

namespace App\Services\Category;

use App\Interfaces\Repository\CategoryRepositoryInterface;

class Add
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

    public function __invoke(array $record)
    {
        /**
         * 新規データを格納
         */
        $newCategoryEntity = $this->categoryRepository->new([
            'category' => $record['category'],
        ]);

        /**
         * 新規データの永続
         */
        $this->categoryRepository->persist($newCategoryEntity);
    }
}