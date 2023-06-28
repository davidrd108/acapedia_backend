<?php

namespace Business\Repository\Implementations;

use App\Mappers\PostMapper;
use App\Models\Post;
use Business\Entities\PostEntity;
use Business\Repository\PostRepository;

class PostRepositoryImpl implements PostRepository
{
  public function create(PostEntity $postEntity, $loadParams = null)
  {
    $post = PostMapper::mapPostEntityToModel($postEntity);
    $post->save();

    if (isset($loadParams['relations'])) {
      $post->load($loadParams['relations']);
    }

    return PostMapper::mapModelToPostEntity($post);
  }

  public function findAll($params = null)
  {
    return Post::query()
      ->withRelations($params)
      ->get()
      ->map(fn ($post) => PostMapper::mapModelToPostEntity($post));
  }

  public function findOne(int $postId, $params = null)
  {
    $post = Post::query($postId)
      ->withRelations($params)
      ->find($postId);

    return PostMapper::mapModelToPostEntity($post);
  }
}
