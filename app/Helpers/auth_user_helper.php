<?php

use App\Models\User;

function authUser()
{
    $user = new User();
    return $user->find(session()->get("id"));

}
