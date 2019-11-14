<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    /**
     * 全てのカテゴリを取得する
     * @return mixed
     */
    public function getAllCategories();

    /**
     * 特定のカテゴリデータを取得する
     * @param $id
     * @return mixed
     */
    public function getCategory($id);

    /**
     * カテゴリの新規作成処理
     * @param array $param
     * @return mixed
     */
    public function createCategory(array $param): void;

    /**
     * カテゴリの更新処理
     * @param array $param
     * @return mixed
     */
    public function updateCategory(array $param): void;

    public function deleteCategory(array $param): void;
}
