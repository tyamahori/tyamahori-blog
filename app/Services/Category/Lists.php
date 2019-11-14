<?php

namespace App\Services\Category;

use App\Interfaces\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class Lists
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

    /**
     * @return Collection
     */
    public function __invoke()
    {
        return $this->categoryRepository->list();
    }
}