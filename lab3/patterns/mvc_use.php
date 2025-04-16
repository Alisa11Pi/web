<?php
require_once __DIR__ . '/mvc/models/users.php';
require_once __DIR__ . '/mvc/views/MarkdownView.php';
require_once __DIR__ . '/mvc/controllers/controller.php';

use patterns\mvc\controllers\Controller;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$controller = new Controller('users.md');
echo "<pre>" . $controller->render() . "</pre>";

echo "</body></html>";

