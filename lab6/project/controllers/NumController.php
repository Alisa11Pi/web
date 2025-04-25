<?php
namespace Project\Controllers;

use core\Controller;

class NumController extends Controller
{
    public function sum($params)
    {
        $this->title = 'Сумма чисел';
        if (isset($params['n1']) && isset($params['n2']) && isset($params['n3'])) {
            $n1 = (int)$params['n1'];
            $n2 = (int)$params['n2'];
            $n3 = (int)$params['n3'];
            
            $sum = $n1 + $n2 + $n3;
            echo "Сумма чисел $n1, $n2 и $n3 равна: $sum";
        } else {
            echo "Ошибка: не все параметры переданы";
        }
    }
}