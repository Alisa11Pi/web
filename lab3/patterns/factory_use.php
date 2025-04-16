<?php
spl_autoload_register();

use Factory\Router;
use Factory\Models\User;

$usersCollection = Router::parse('users');
$users = $usersCollection->getUsers();

echo "## Список пользователей (Markdown)<br>";

foreach ($users as $user) {
    echo "### {$user->getFirstName()} {$user->getLastName()}<br>";
    echo "- **Email:** {$user->getEmail()}<br>";
    echo "- **Пароль:** {$user->getMaskedPassword()}<br>";
}