<?php

namespace App\Repositories\Concretes;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MysqlCategoryRepository implements CategoryRepositoryInterface
{
    /**
     * カテゴリモデルが格納される
     * @var Category
     */
    protected $category;

    /**
     * MysqlCategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * 全てのカテゴリを取得する
     * @return Category[]|Collection
     */
    public function getAllCategories()
    {
        return $this->category::all();
    }

    /**
     * idで指定したカテゴリを取得する
     * @param $id
     * @return mixed
     */
    public function getCategory($id)
    {
        return $this->category->find($id);
    }

    /**
     * カテゴリ登録処理
     * @param array $param
     */
    public function createCategory(array $param): void
    {
        $this->category->nameColumnData = $param[$this->category::getNameColumn()];
        $this->category->save();
    }

    /**
     * カテゴリ更新処理
     * @param array $param
     */
    public function updateCategory(array $param): void
    {
        $updatedCategory                 = $this->category::find($param[$this->category::getPrimaryKeyColumnName()]);
        $updatedCategory->nameColumnData = $param[$this->category::getNameColumn()];
        $updatedCategory->save();
    }

    /**
     * カテゴリの削除処理
     * @param array $param
     */
    public function deleteCategory(array $param): void
    {
        $this->category::find($param[$this->category::getPrimaryKeyColumnName()])->delete();
    }
}
