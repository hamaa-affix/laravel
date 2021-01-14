<?php

namespace App\Repository\User;

use DB;

class UserQBRepository implements UserRepositoryInterface {
  protected $table = 'users';


  public function getAllUser()
  {
    return DB::table($this->table)->get();
  }
  public function getUser($user_id)
  {
    return DB::table($this->table)->where('id', $user_id);
  }
}
