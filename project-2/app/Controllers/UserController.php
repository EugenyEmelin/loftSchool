<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends AppController
{
    public function all()
    {
        $userModel = new User();
        $users = $userModel->all();
        $title = 'Список пользователей';
        $theads = ['Фото', 'Имя', 'Email', 'Возраст', 'Дата регистрации', 'Описание'];
        $this->set(compact('title', 'users', 'theads'));
    }
}