<?php

namespace RefactoringGuru\Decorator\Conceptual;

/**
 * Паттерн Декоратор
 *
 * Назначение: Позволяет динамически добавлять объектам новую функциональность,
 * оборачивая их в полезные «обёртки».
 */
interface Component
{
    public function operation(): string;
}

/**
 * Конкретные Компоненты предоставляют реализации поведения по умолчанию.
 */
class ConcreteComponent implements Component
{
    public function operation(): string
    {
        return "ConcreteComponent";
    }
}

/**
 * Базовый класс Декоратора.
 */
class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function operation(): string
    {
        return $this->component->operation();
    }
}

/**
 * Конкретные Декораторы добавляют свою функциональность.
 */
class ConcreteDecoratorA extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorA(" . parent::operation() . ")";
    }
}

class ConcreteDecoratorB extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorB(" . parent::operation() . ")";
    }
}

/**
 * Клиентский код работает со всеми объектами через интерфейс Компонента.
 */
function clientCode(Component $component)
{
    echo "РЕЗУЛЬТАТ: " . $component->operation();
}

// Работа с простым компонентом
$simple = new ConcreteComponent();
echo "Клиент: У меня простой компонент:<br>";
clientCode($simple);
echo "<br>";

// Работа с декорированным компонентом
$decorator1 = new ConcreteDecoratorA($simple);
$decorator2 = new ConcreteDecoratorB($decorator1);
echo "Клиент: Теперь у меня декорированный компонент:<br>";
clientCode($decorator2);