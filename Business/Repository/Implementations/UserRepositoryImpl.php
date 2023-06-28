<?php

namespace Business\Repository\Implementations;

use App\Models\User;
use Business\Repository\UserRepository;

class UserRepositoryImpl implements UserRepository
{
  public function exists(int $userId): bool
  {
    return User::whereId($userId)->exists();
  }
}
