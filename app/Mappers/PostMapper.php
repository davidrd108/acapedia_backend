<?php

namespace App\Mappers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Business\Entities\PostEntity;

class PostMapper
{

  static function mapCreateRequestToPostEntity(StorePostRequest $request): PostEntity
  {
    $postEntity = new PostEntity();

    $postEntity->title = $request->title;
    $postEntity->description = $request->description;
    $postEntity->categoryId = $request->categoryId;
    $postEntity->userId = $request->userId;

    return $postEntity;
  }

  static function mapPostEntityToModel(PostEntity $postEntity): Post
  {

    $post = new Post();

    $post->title = $postEntity->title;
    $post->description = $postEntity->description;
    $post->category_id = $postEntity->categoryId;
    $post->user_id = $postEntity->userId;

    return $post;
  }

  static function mapModelToPostEntity(Post $post): PostEntity
  {

    $postEntity = new PostEntity();

    $postEntity->id = $post->id;
    $postEntity->createdAt = $post->created_at;
    $postEntity->updatedAt = $post->updated_at;

    $postEntity->title = $post->title;
    $postEntity->description = $post->description;
    $postEntity->categoryId = $post->category_id;
    $postEntity->userId = $post->user_id;

    if ($post->relationLoaded('category')) {
      $postEntity->category = CategoryMapper::mapModelToCategoryEntity($post->category);
    }

    if ($post->relationLoaded('user')) {
      $postEntity->user = UserMapper::mapModelToUserEntity($post->user);
    }

    return $postEntity;
  }
}
