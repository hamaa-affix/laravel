<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Repository\User\UserRepositoryInterface AS UserDataAccess;


class UserContoller extends Controller
{

    protected $User;

    public function __construct(UserDataAccess $UserDataAccess)
    {
        $this->User = $UserDataAccess;
    }

    public function showProfile($id)
    {
        $user = $this->User->getUser($id);

        return view("users.show_profile", compact("user"));
    }

    public function create() {
        return view("users.create");
    }

    // public function store(Request $request) {
    //     User::create($request->all());
    //     return redirect()->route("");
    // }
}
