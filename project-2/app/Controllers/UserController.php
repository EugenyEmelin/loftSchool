<?php
namespace App\Controllers;

use App\Core\App;
use App\Core\base\View;
use App\Models\User;

class UserController extends AppController
{
    public function all()
    {
        new User();
//        $this->setMetadata('Пользователи', 'Страница вывода списка пользователей', 'ключевые слова');
//        $metadata = $this->metadata;
        View::setMetaData('Пользователи', 'Страница вывода списка пользователей', 'ключевые слова');
        $users = App::$app->cache->get('users');
        if (!$users) {
            $users = \R::findAll('users');
            App::$app->cache->set('users', $users, 3600*24);
        }
        App::$app->cache->set('users', $users);
        if ($this->isAjax()) {
            $user = \R::findOne('users', "id = {$_POST['id']}");
            print_r($user->username);
            die();
        }
        $theads = ['Фото', 'Имя', 'Email', 'Возраст', 'Дата регистрации', 'Описание'];
        $this->set(compact('title', 'users', 'theads', 'metadata'));
    }
    public function getUserById($id) {
        if ($this->isAjax()) {
            $user = \R::findOne('user', "id = {$_POST['id']}");
            print_r($user);
            die();
        }
    }
}