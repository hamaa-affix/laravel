<?php

namespace App\Repository\User;

use App\User;

class UserEQRepository implements UserRepositoryInterface
{
  public function getAllUser()
  {
    return User::all();
  }

  public function getUser($user_id): User
  {
    return User::find($user_id);
  }
}
