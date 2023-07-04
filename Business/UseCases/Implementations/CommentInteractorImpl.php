<?php

namespace Business\UseCases\Implementations;

use Business\Entities\CommentEntity;
use Business\Repository\CommentRepository;
use Business\Repository\UserRepository;
use Business\UseCases\CommentInteractor;
use InvalidArgumentException;

class CommentInteractorImpl implements CommentInteractor
{
  private UserRepository $userRepository;
  private CommentRepository $commentRepository;

  public function __construct(
    UserRepository $userRepository,
    CommentRepository $commentRepository
  ) {
    $this->userRepository = $userRepository;
    $this->commentRepository = $commentRepository;
  }

  public function addCommentToPost(CommentEntity $comment)
  {
    if (!$this->userRepository->exists($comment->userId)) {
      throw new InvalidArgumentException('The related user is required');
    }

    $withRelations = ['user', 'post'];
    $loadParams = ['relations' => $withRelations];

    return $this->commentRepository->create($comment, $loadParams);
  }

  public function listComments($postId)
  {
    return $this->commentRepository->findAll();
    return $this->commentRepository->findAll(['post_id' => $postId]);
  }

  public function deleteComment($id)
  {
    return $this->commentRepository->remove($id);
  }
}
