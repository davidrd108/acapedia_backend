<?php

namespace Business\Repository;

use Business\Entities\CommentEntity;

interface CommentRepository
{
  public function create(CommentEntity $comment, $loadParams = null);
  public function findAll($params = null);
  public function remove(int $postId);
}
