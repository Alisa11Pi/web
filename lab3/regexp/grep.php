<?php
foreach (preg_grep('/^ex\d/s', glob('*')) as $fn) {
    echo "Файл примера: $fn<br />";
}
