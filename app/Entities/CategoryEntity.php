<?php

namespace App\Entities;

use App\Eloquent\CategoryOrm;
use App\Exceptions\ValueObjectError;
use App\Interfaces\Entity\CategoryInterface;
use App\ValueObject\CategoryId;
use App\ValueObject\CategoryName;

class CategoryEntity implements CategoryInterface
{
    private $categoryOrm;

    /**
     * PostEntity constructor.
     * @param CategoryOrm $categoryOrm
     */
    public function __construct(CategoryOrm $categoryOrm)
    {
        $this->categoryOrm = $categoryOrm;
    }

    /**
     * IDを取得する
     * @return CategoryId
     */
    public function getId(): CategoryId
    {
        return CategoryId::of($this->categoryOrm->primary_key_data);
    }

    /**
     * titleを取得する
     * @return CategoryName
     * @throws ValueObjectError
     */
    public function getName(): CategoryName
    {
        return CategoryName::of($this->categoryOrm->name_data);
    }
}