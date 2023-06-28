<?php

namespace App\Mappers;

use App\Models\User;
use Business\Entities\UserEntity;

class UserMapper
{

  static function mapUserEntityToModel(UserEntity $userEntity)
  {

    $user = new User();

    $user->name = $userEntity->name;
    $user->email = $userEntity->email;

    return $user;
  }

  static function mapModelToUserEntity(User $user)
  {

    $userEntity = new UserEntity();

    $userEntity->id = $user->id;
    $userEntity->createdAt = $user->created_at;
    $userEntity->updatedAt = $user->updated_at;

    $userEntity->name = $user->name;
    $userEntity->email = $user->email;

    if ($user->relationLoaded('posts')) {
      $userEntity->posts = $user->posts->map(fn ($post) => PostMapper::mapModelToPostEntity($post));
    }

    return $userEntity;
  }
}
