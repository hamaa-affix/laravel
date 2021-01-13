<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserContoller extends Controller
{
    public function showProfile(User $user) {
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
