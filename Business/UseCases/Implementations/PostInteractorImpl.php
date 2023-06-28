<?php

namespace Business\UseCases\Implementations;

use Business\Entities\PostEntity;
use Business\Repository\CategoryRepository;
use Business\Repository\PostRepository;
use Business\Repository\UserRepository;
use Business\UseCases\PostInteractor;
use InvalidArgumentException;

class PostInteractorImpl implements PostInteractor
{
  private PostRepository $postRepository;
  private UserRepository $userRepository;
  private CategoryRepository $categoryRepository;

  public function __construct(
    PostRepository $postRepository,
    UserRepository $userRepository,
    CategoryRepository $categoryRepository
  ) {
    $this->postRepository = $postRepository;
    $this->userRepository = $userRepository;
    $this->categoryRepository = $categoryRepository;
  }

  public function createPost(PostEntity $post)
  {
    if (!$this->userRepository->exists($post->userId)) {
      throw new InvalidArgumentException('The related user is required');
    }

    if (!$this->categoryRepository->exists($post->categoryId)) {
      throw new InvalidArgumentException('The related category is required');
    }

    $withRelations = ['user', 'category'];
    $loadParams = ['relations' => $withRelations];

    return $this->postRepository->create($post, $loadParams);
  }

  public function listPosts($params = [])
  {
    return $this->postRepository->findAll($params);
  }

  public function showPost($postId)
  {
    $withRelations = ['user', 'category'];
    $params = ['relations' => $withRelations];

    return $this->postRepository->findOne($postId, $params);
  }
}
