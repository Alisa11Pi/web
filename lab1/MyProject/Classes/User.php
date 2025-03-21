<?php

class User {
    public $name;
    public $login;
    private $password;

    // Конструктор для инициализации свойств
    public function __construct($name, $login, $password) {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }

    // Метод для вывода информации о пользователе
    public function showInfo() {
        echo "Информация о пользователе:\n";
        echo "Имя: " . $this->name . "\n";
        echo "Логин: " . $this->login . "\n";
        echo "Пароль: [скрыт]\n"; 
        echo "-----------------------------\n";
    }
}
?>