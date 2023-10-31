<?php

use App\Models\User;

function user()
{
    $user = new User();
    return $user->find(session()->get("id"));

}

function authUser()
{
    $data = [
        'id' => session()->get('id'),
        'name' => session()->get('name'),
        'email' => session()->get('email'),
        'lang' => session()->get('lang'),
        'image' => session()->get('image'),
        'isLoggedIn' => true,
    ];
    return $data;
}
