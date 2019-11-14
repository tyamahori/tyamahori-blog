<?php

namespace App\Interfaces\Entity;

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
}