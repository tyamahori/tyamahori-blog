<?php

namespace App\Services;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 全てのカテゴリを取得する処理
     * @return mixed
     */
    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCategory($id)
    {
        return $this->categoryRepository->getCategory($id);
    }

    /**
     * カテゴリの新規登録処理
     * @param CategoryRequest $request
     */
    public function createCategoryData(CategoryRequest $request): void
    {
        $nameColumn = Category::getNameColumn();

        $this->categoryRepository->createCategory([
            $nameColumn => $request->$nameColumn
        ]);
    }

    /**
     * カテゴリの更新処理
     * @param CategoryRequest $request
     */
    public function updateCategoryData(CategoryRequest $request): void
    {
        $primaryKeyColumn = Category::getPrimaryKeyColumnName();
        $nameColumn       = Category::getNameColumn();

        $this->categoryRepository->updateCategory([
            $primaryKeyColumn => $request->$primaryKeyColumn,
            $nameColumn       => $request->$nameColumn
        ]);
    }

    /**
     * カテゴリの削除処理
     * @param Request $request
     */
    public function deleteCategoryData(Request $request): void
    {
        $primaryKeyColumn = Category::getPrimaryKeyColumnName();

        $this->categoryRepository->deleteCategory([
            $primaryKeyColumn => $request->$primaryKeyColumn,
        ]);
    }
}
