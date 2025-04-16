<?php

namespace RefactoringGuru\Adapter\Conceptual;

/**
 * Целевой класс объявляет интерфейс, с которым может работать клиентский код.
 */
class Target
{
    public function request(): string
    {
        return "Цель: Стандартное поведение целевого объекта.<br>";
    }
}

/**
 * Адаптируемый класс содержит полезное поведение, но его интерфейс
 * несовместим с клиентским кодом.
 */
class Adaptee
{
    public function specificRequest(): string
    {
        return ".eetpadA eht fo roivaheb laicepS "; // Специальное поведение Adaptee
    }
}

/**
 * Адаптер делает интерфейс Адаптируемого класса совместимым с целевым интерфейсом.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Адаптер: (ПЕРЕВЕДЕНО) " . strrev($this->adaptee->specificRequest());
    }
}

/**
 * Клиентский код работает с классами через целевой интерфейс.
 */
function clientCode(Target $target)
{
    echo $target->request();
}

echo "Клиент: Я могу работать с целевыми объектами:<br>";
$target = new Target();
clientCode($target);
echo "<br>";

$adaptee = new Adaptee();
echo "Клиент: У класса Adaptee странный интерфейс. Я его не понимаю:<br>";
echo "Adaptee: " . $adaptee->specificRequest();
echo "<br>";

echo "Клиент: Но я могу работать с ним через Адаптер:<br>";
$adapter = new Adapter($adaptee);
clientCode($adapter);