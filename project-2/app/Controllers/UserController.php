<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends AppController
{
    public function all()
    {
        $userModel = new User();
        $this->setMetadata('Пользователи', 'Страница вывода списка пользователей', 'ключевые слова');
        $metadata = $this->metadata;
        $users = \R::findAll('users');
        $theads = ['Фото', 'Имя', 'Email', 'Возраст', 'Дата регистрации', 'Описание'];
        $this->set(compact('title', 'users', 'theads', 'metadata'));
    }
}