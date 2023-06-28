<?php

namespace Business\Repository;

interface UserRepository
{
  public function exists(int $userId): bool;
}
