<?php

// подключение файла к классу User
require __DIR__.'/MyProject/Classes/User.php';

// создание объектов класса
$user1 = new User("Иван", "Ivan", "1234");
$user2 = new User("Настя", "Nastya", "qwer");
$user3 = new User("Петя", "Petya", "1234qwer");

// Вызываем метод showInfo() для каждого объекта
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();
?>