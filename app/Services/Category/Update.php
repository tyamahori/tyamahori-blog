<?php

namespace App\Services\Category;

use App\Exceptions\ValueObjectError;
use App\Interfaces\Repository\CategoryRepositoryInterface;
use App\ValueObject\CategoryId;
use App\ValueObject\CategoryName;

class Update
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
         * 入力データの整形
         */
        $inputData = [
            'id'   => $record['id'],
            'name' => $record['category'],
        ];

        /**
         * 更新するべきエンティティの取得
         */
        $currentCategoryEntity = $this->categoryRepository->find(CategoryId::of($inputData['id']));
        if ($currentCategoryEntity === null) {
            abort(404);
        }

        /**
         * 値を格納する
         * @throws ValueObjectError
         */
        $currentCategoryEntity->setName(CategoryName::of($inputData['name']));

        /**
         * 新規データの永続
         */
        $this->categoryRepository->persist($currentCategoryEntity);
    }
}