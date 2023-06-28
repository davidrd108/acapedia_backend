<?php

namespace Business\Repository;

interface CategoryRepository
{
  public function exists(int $categoryId): bool;
}
