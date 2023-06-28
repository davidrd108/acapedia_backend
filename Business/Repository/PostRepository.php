<?php

namespace Business\Repository;

use Business\Entities\PostEntity;

interface PostRepository
{
  public function create(PostEntity $post, $loadParams = null);
  public function findAll($params = null);
  public function findOne(int $postId, $params = null);
}
