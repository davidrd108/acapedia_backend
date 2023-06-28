<?php

namespace App\Mappers;

use App\Models\Category;
use Business\Entities\CategoryEntity;

class CategoryMapper
{

  static function mapCategoryEntityToModel(CategoryEntity $categoryEntity)
  {

    $category = new Category();

    $category->name = $categoryEntity->name;
    $category->description = $categoryEntity->description;

    return $category;
  }

  static function mapModelToCategoryEntity(Category $category)
  {

    $categoryEntity = new CategoryEntity();

    $categoryEntity->id = $category->id;
    $categoryEntity->createdAt = $category->created_at;
    $categoryEntity->updatedAt = $category->updated_at;

    $categoryEntity->name = $category->name;
    $categoryEntity->description = $category->description;

    if ($category->relationLoaded('category')) {
      $categoryEntity->category = CategoryMapper::mapModelToCategoryEntity($category->category);
    }

    return $categoryEntity;
  }
}
