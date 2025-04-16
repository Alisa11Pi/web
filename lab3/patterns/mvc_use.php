<?php
spl_autoload_register();

use MVC\Controllers\Controller;

$controller = new Controller('users.md');
echo $controller->render();