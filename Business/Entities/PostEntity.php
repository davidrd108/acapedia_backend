<?php

namespace Business\Entities;

class PostEntity extends BaseEntity
{
  public string $title;
  public string $description;

  public CategoryEntity $category;
  public UserEntity $user;

  public int $categoryId;
  public int $userId;
}
