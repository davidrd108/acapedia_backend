<?php

namespace Business\Repository;

use Business\Entities\PostEntity;

interface PostRepository
{
  public function create(PostEntity $post, $loadParams = null);
  public function update(PostEntity $post);
  public function findAll($params = []);
  public function findOne(int $postId, $params = null);
}
