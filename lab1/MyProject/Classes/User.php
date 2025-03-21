<?php

namespace MyProject\Classes;

class User extends AbstractUser {
    public $name;
    public $login;
    private $password;
    public static $count = 0;

    // Конструктор для инициализации свойств
    public function __construct($name, $login, $password) {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        self::$count++;
    }

    // Метод для вывода информации о пользователе
    public function showInfo() {
        echo "<pre> Информация о пользователе:";
        echo "<pre> Имя: " . $this->name;
        echo "<pre> Логин: " . $this->login;
        echo "<pre> Пароль: [скрыт]"; 
        echo "<pre> -----------------------------";
    }

    // Деструктор
    public function __destruct() {
        echo "<pre> Пользователь [" . $this->login . "] удален";
    }
}
?>