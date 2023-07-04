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

  public function update(PostEntity $postEntity)
  {
    $post = PostMapper::mapUpdatePostEntityToModel($postEntity);
    $post->save();

    if (isset($loadParams['relations'])) {
      $post->load($loadParams['relations']);
    }

    return PostMapper::mapModelToPostEntity($post);
  }

  public function findAll($params = null)
  {
    $posts = Post::query();

    if (key_exists("category", $params) && strlen($params['category']) > 0) {
      $posts->where('category_id', $params['category']);
    }

    if (key_exists("search", $params) && strlen($params['search']) > 0) {
      $posts->where('title', 'like', '%' . $params['search'] . '%');
    }

    return $posts
      ->withRelations(key_exists("relations", $params) ? $params['relations'] : null)
      ->paginate();
  }

  public function findOne(int $postId, $params = null)
  {
    $post = Post::query($postId)
      ->withRelations($params)
      ->find($postId);

    return PostMapper::mapModelToPostEntity($post);
  }

  public function remove($postId)
  {
    $post = Post::query($postId)
      ->find($postId);

    $post->delete();
  }
}
