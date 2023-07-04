<?php

namespace Business\Repository\Implementations;

use App\Mappers\CommentMapper;
use App\Mappers\PostMapper;
use App\Models\Comment;
use Business\Entities\CommentEntity;
use Business\Repository\CommentRepository;

class CommentRepositoryImpl implements CommentRepository
{
  public function create(CommentEntity $commentEntity, $loadParams = null)
  {
    $comment = CommentMapper::mapCommentEntityToModel($commentEntity);
    $comment->save();

    if (isset($loadParams['relations'])) {
      $comment->load($loadParams['relations']);
    }

    return CommentMapper::mapModelToCommentEntity($comment);
  }

  public function findAll($params = null)
  {
    return Comment::query()
      ->withRelations($params)
      ->get()
      ->map(fn ($comment) => CommentMapper::mapModelToCommentEntity($comment));
  }

  public function findOne(int $commentId, $params = null)
  {
    $comment = comment::query($commentId)
      ->withRelations($params)
      ->find($commentId);

    return CommentMapper::mapModelToCommentEntity($comment);
  }

  public function remove($commentId)
  {
    $post = Comment::query($commentId)
      ->find($commentId);

    $post->delete();
  }
}
