<?php

namespace App\Interfaces\Entity;

use App\ValueObject\TagId;
use App\ValueObject\TagName;

interface TagInterface
{
    /**
     * IDを取得する
     * @return TagId
     */
    public function getId(): TagId;

    /**
     * nameを取得する
     * @return TagName
     */
    public function getName(): TagName;
}