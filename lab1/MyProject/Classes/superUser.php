<?php

namespace MyProject\Classes;

require_once __DIR__.'/User.php';

// Наследование от User
class SuperUser extends User implements SuperUserInterface {

    public $role;
    public static $count = 0;

    // Перегруженный конструктор
    public function __construct($name, $login, $password, $role) {
        parent::__construct($name, $login, $password);
        $this->role = $role;
        self::$count++;
    }

    public function showInfo() {
        echo "<pre> Информация о пользователе:";
        echo "<pre> Имя: " . $this->name;
        echo "<pre> Логин: " . $this->login;
        echo "<pre> Роль: " . $this->role;
        echo "<pre> Пароль: [скрыт]"; 
        echo "<pre> -----------------------------";
    }

    public function getInfo() {
        return [
            'name' => $this->name,
            'login' => $this->login,
            'role' => $this->role,
            'password' => '[скрыт]' 
        ];
    }
}
?>