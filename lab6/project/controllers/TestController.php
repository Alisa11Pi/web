<?php
namespace Project\Controllers;

use Core\Controller;

class TestController extends Controller
{
    public function act1()
    {
        $this->title = 'Действие 1';
        echo "Действие 1";
    }

    public function act2()
    {
        $this->title = 'Действие 2';
        echo "Действие 2";
    }

    public function act3()
    {
        $this->title = 'Действие 3';
        echo "Действие 3";
    }
}