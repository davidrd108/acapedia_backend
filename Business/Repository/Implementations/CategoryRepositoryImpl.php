<?php

namespace Business\Repository\Implementations;

use App\Models\Category;
use Business\Repository\CategoryRepository;

class CategoryRepositoryImpl implements CategoryRepository
{
  public function exists(int $categoryId): bool
  {
    return Category::whereId($categoryId)->exists();
  }
}
