<?php

namespace App\Interfaces\Entity;

use App\Eloquent\CategoryOrm;
use App\ValueObject\CategoryId;
use App\ValueObject\CategoryName;

interface CategoryInterface
{
    /**
     * IDを取得する
     * @return CategoryId
     */
    public function getId(): CategoryId;

    /**
     * nameを取得する
     * @return CategoryName
     */
    public function getName(): CategoryName;

    /**
     * ORMを取得するメソッド
     * @return CategoryOrm
     */
    public function getCategoryOrm(): CategoryOrm;

    /**
     * ORMを削除するメソッド
     */
    public function delete(): void;
}