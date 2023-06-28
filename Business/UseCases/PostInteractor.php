<?php

namespace Business\UseCases;

use Business\Entities\PostEntity;

interface PostInteractor
{
  public function createPost(PostEntity $post);
  public function showPost(int $postId);
  public function listPosts();
}
