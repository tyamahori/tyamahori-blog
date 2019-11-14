<?php

namespace App\Entities;

use App\Eloquent\TagOrm;
use App\Exceptions\ValueObjectError;
use App\Interfaces\Entity\TagInterface;
use App\ValueObject\TagId;
use App\ValueObject\TagName;

class TagEntity implements TagInterface
{
    private $tagOrm;

    /**
     * PostEntity constructor.
     * @param TagOrm $tagOrm
     */
    public function __construct(TagOrm $tagOrm)
    {
        $this->tagOrm = $tagOrm;
    }

    /**
     * IDを取得する
     * @return TagId
     */
    public function getId(): TagId
    {
        return TagId::of($this->tagOrm->primary_key_data);
    }

    /**
     * titleを取得する
     * @return TagName
     * @throws ValueObjectError
     */
    public function getName(): TagName
    {
        return TagName::of($this->tagOrm->name_data);
    }
}