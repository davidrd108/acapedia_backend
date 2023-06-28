<?php

namespace App\Mappers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Business\Entities\CommentEntity;

class CommentMapper
{

  static function mapCreateRequestToCommentEntity(StoreCommentRequest $request): CommentEntity
  {
    $commentEntity = new CommentEntity();

    $commentEntity->text = $request->title;
    $commentEntity->postId = $request->postId;
    $commentEntity->userId = $request->userId;

    return $commentEntity;
  }

  static function mapCommentEntityToModel(CommentEntity $commentEntity): Comment
  {

    $comment = new Comment();

    $comment->text = $commentEntity->text;
    $comment->post_id = $commentEntity->postId;
    $comment->user_id = $commentEntity->userId;

    return $comment;
  }

  static function mapModelToCommentEntity(Comment $comment): CommentEntity
  {

    $commentEntity = new CommentEntity();

    $commentEntity->id = $comment->id;
    $commentEntity->createdAt = $comment->created_at;
    $commentEntity->updatedAt = $comment->updated_at;

    $commentEntity->text = $comment->text;
    $commentEntity->postId = $comment->post_id;
    $commentEntity->userId = $comment->user_id;

    if ($comment->relationLoaded('post')) {
      $commentEntity->post = PostMapper::mapModelToPostEntity($comment->post);
    }

    if ($comment->relationLoaded('user')) {
      $commentEntity->user = UserMapper::mapModelToUserEntity($comment->user);
    }

    return $commentEntity;
  }
}
