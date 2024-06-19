<?php

namespace WebDir\core\appli\core\services\user;

use WebDir\core\appli\core\domain\entities\User;
use WebDir\core\appli\core\services\user\UserServiceInterface;

class UserService implements UserServiceInterface{

    public function inBD ($user){
        return User::where('id',$user)->exists();
    }

    public function addUser($data){
        $user = new User();
        $user->id = $data['id'];
        $user->password = $data['pwd'];
        $user->role = 1;
        $user->save();
    }

}