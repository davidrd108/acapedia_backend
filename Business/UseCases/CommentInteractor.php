<?php

namespace Business\UseCases;

use Business\Entities\CommentEntity;

interface CommentInteractor
{
  public function addCommentToPost(CommentEntity $comment);
  public function listComments($postId);
  public function deleteComment($id);
}
