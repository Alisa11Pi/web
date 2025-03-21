<?php

spl_autoload_register(function ($class) {
    // Меняем путь к файлу
    $file = str_replace('\\', '/', $class) . '.php';

    // Проверка
    if (file_exists($file)) {
        require $file;
    } else {
        throw new Exception("Файл класса {$class} не найден.");
    }
});

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

// создание объектов класса
$user1 = new User("Иван", "Ivan", "1234");
$user2 = new User("Настя", "Nastya", "qwer");
$user3 = new User("Петя", "Petya", "1234qwer");
$user = new SuperUser("Администратор", "admin", "admin", "Админ");

// Вызываем метод showInfo() для каждого объекта
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();
$user->showInfo();

// Вызываем метод getInfo() и выводим результат с помощью print_r
$userInfo = $user->getInfo();
echo "<pre>";
print_r($userInfo);
echo "</pre>";

// Выводим количество созданных экземпляров
echo "Всего обычных пользователей: " . User::$count - SuperUser::$count . "<br>";
echo "Всего супер-пользователей: " . SuperUser::$count . "<br>";
?>