<?php

namespace Business\Entities;

class CommentEntity extends BaseEntity
{
  public string $text;

  public PostEntity $post;
  public UserEntity $user;

  public int $postId;
  public int $userId;
}
