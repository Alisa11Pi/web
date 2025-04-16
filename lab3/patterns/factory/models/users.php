<?php
namespace Factory\Models;

class Users extends Collection
{
    private array $users;

    public function __construct(array $users = [])
    {
        $this->users = $users ?: [
            new User('dmitry.koterov@gmail.com', 'password', 'Дмитрий', 'Котеров'),
            new User('igorsimdyanov@gmail.com', 'password', 'Игорь', 'Симдянов'),
            new User('alex.pushkin@gmail.com', 'password123', 'Александр', 'Пушкин'),
            new User('leo.tolstoy@mail.ru', 'warandpeace', 'Лев', 'Толстой'),
            new User('fedor.dostoevsky@yandex.ru', 'crimepunish', 'Фёдор', 'Достоевский')
        ];
        parent::__construct($this->users);
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}