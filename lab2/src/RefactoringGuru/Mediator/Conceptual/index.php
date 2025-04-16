<?php

namespace RefactoringGuru\Mediator\Conceptual;

/**
 * Паттерн Посредник
 *
 * Назначение: Уменьшает связанность классов, вынося взаимодействие в отдельный
 * класс-посредник.
 */
interface Mediator
{
    public function notify(object $sender, string $event): void;
}

/**
 * Конкретный посредник координирует взаимодействие компонентов.
 */
class ConcreteMediator implements Mediator
{
    private $component1;
    private $component2;

    public function __construct(Component1 $c1, Component2 $c2)
    {
        $this->component1 = $c1;
        $this->component1->setMediator($this);
        $this->component2 = $c2;
        $this->component2->setMediator($this);
    }

    public function notify(object $sender, string $event): void
    {
        if ($event == "A") {
            echo "Посредник реагирует на A и запускает следующие операции:<br>";
            $this->component2->doC();
        }

        if ($event == "D") {
            echo "Посредник реагирует на D и запускает следующие операции:<br>";
            $this->component1->doB();
            $this->component2->doC();
        }
    }
}

/**
 * Базовый класс для компонентов, хранящий ссылку на посредника.
 */
class BaseComponent
{
    protected $mediator;

    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}

/**
 * Конкретные компоненты реализуют свою функциональность независимо от других.
 */
class Component1 extends BaseComponent
{
    public function doA(): void
    {
        echo "Компонент 1 выполняет A.<br>";
        $this->mediator->notify($this, "A");
    }

    public function doB(): void
    {
        echo "Компонент 1 выполняет B.<br>";
        $this->mediator->notify($this, "B");
    }
}

class Component2 extends BaseComponent
{
    public function doC(): void
    {
        echo "Компонент 2 выполняет C.<br>";
        $this->mediator->notify($this, "C");
    }

    public function doD(): void
    {
        echo "Компонент 2 выполняет D.<br>";
        $this->mediator->notify($this, "D");
    }
}

/**
 * Клиентский код.
 */
$c1 = new Component1();
$c2 = new Component2();
$mediator = new ConcreteMediator($c1, $c2);

echo "Клиент запускает операцию A.<br>";
$c1->doA();

echo "<br>";
echo "Клиент запускает операцию D.<br>";
$c2->doD();