<?php
namespace Project\Controllers;

use core\Controller;

class UserController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = [
            1 => ['name'=>'user1', 'age'=>'23', 'salary' => 1000],
            2 => ['name'=>'user2', 'age'=>'24', 'salary' => 2000],
            3 => ['name'=>'user3', 'age'=>'25', 'salary' => 3000],
            4 => ['name'=>'user4', 'age'=>'26', 'salary' => 4000],
            5 => ['name'=>'user5', 'age'=>'27', 'salary' => 5000],
        ];
    }

    public function show($params)
    {
        $id = $params['id'];
        if (isset($this->users[$id])) {
            $this->title = 'Пользователь ' . $this->users[$id]['name'];
            var_dump($this->users[$id]);
        } else {
            $this->title = 'Пользователь не найден';
            echo "Пользователь не найден";
        }
    }

    public function info($params)
    {
        $id = $params['id'];
        $key = $params['key'];
        $this->title = 'Информация о пользователе';
        if (isset($this->users[$id]) && isset($this->users[$id][$key])) {
            echo $this->users[$id][$key];
        } else {
            echo "Информация не найдена";
        }
    }

    public function all($params = [])  
    {
        $this->title = 'Все пользователи';
        if (!empty($this->users)) {  
            foreach ($this->users as $id => $user) {
                echo "ID: $id<br>";
                echo "Имя: {$user['name']}<br>";
                echo "Возраст: {$user['age']}<br>";
                echo "Зарплата: {$user['salary']}<br>";
                echo "<hr>";
            }
        } else {
            echo "Список пользователей пуст";
        }
    }

    public function first($params)
    {
        $n = $params['n'];
        $this->title = 'Первые ' . $n . ' пользователей';
        $result = array_slice($this->users, 0, $n, true);
        var_dump($result);
    }
}