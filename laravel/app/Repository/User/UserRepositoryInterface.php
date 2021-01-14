<?php
namespace App\Repository\User;

interface UserRepositoryInterface {
  public function getAllUser();
  public function getUser($user_id);
}
