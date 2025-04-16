
<?php
spl_autoload_register();

use Singleton\Settings;

Settings::get()->numeric_value = 99;
Settings::get()->string_value = "Hello, World!";
Settings::get()->boolean_value = true;

echo "Числовое значение: " . Settings::get()->numeric_value . "<br>";
echo "Строковое значение: " . Settings::get()->string_value . "<br>";
echo "Логиечское значение: " . (Settings::get()->boolean_value ? 'true' : 'false') . "<br>";
?>