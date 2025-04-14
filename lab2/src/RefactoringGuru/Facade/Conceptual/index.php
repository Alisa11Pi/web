<?php

namespace RefactoringGuru\Facade\Conceptual;

/**
 * Паттерн Фасад
 *
 * Назначение: Предоставляет простой интерфейс к сложной системе классов,
 * библиотеке или фреймворку.
 */
class Facade
{
    protected $subsystem1;
    protected $subsystem2;

    public function __construct(
        Subsystem1 $subsystem1 = null,
        Subsystem2 $subsystem2 = null
    ) {
        $this->subsystem1 = $subsystem1 ?: new Subsystem1();
        $this->subsystem2 = $subsystem2 ?: new Subsystem2();
    }

    public function operation(): string
    {
        $result = "Фасад инициализирует подсистемы:<br>";
        $result .= $this->subsystem1->operation1();
        $result .= $this->subsystem2->operation1();
        $result .= "Фасад запускает выполнение операций подсистем:<br>";
        $result .= $this->subsystem1->operationN();
        $result .= $this->subsystem2->operationZ();

        return $result;
    }
}

/**
 * Подсистема 1
 */
class Subsystem1
{
    public function operation1(): string
    {
        return "Подсистема1: Готова!<br>";
    }

    public function operationN(): string
    {
        return "Подсистема1: Выполняю!<br>";
    }
}

/**
 * Подсистема 2
 */
class Subsystem2
{
    public function operation1(): string
    {
        return "Подсистема2: Подготовка!<br>";
    }

    public function operationZ(): string
    {
        return "Подсистема2: Запуск!<br>";
    }
}

/**
 * Клиентский код работает с подсистемами через Фасад
 */
function clientCode(Facade $facade)
{
    echo $facade->operation();
}

// Использование фасада с предварительно созданными подсистемами
$subsystem1 = new Subsystem1();
$subsystem2 = new Subsystem2();
$facade = new Facade($subsystem1, $subsystem2);
clientCode($facade);