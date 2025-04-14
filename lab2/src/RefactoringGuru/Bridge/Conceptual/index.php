<?php

namespace RefactoringGuru\Bridge\Conceptual;

/**
 * EN: Bridge Design Pattern
 *
 * Intent: Lets you split a large class or a set of closely related classes into
 * two separate hierarchies—abstraction and implementation—which can be
 * developed independently of each other.
 *
 *               A
 *            /     \                        A         N
 *          Aa      Ab        ===>        /     \     / \
 *         / \     /  \                 Aa(N) Ab(N)  1   2
 *       Aa1 Aa2  Ab1 Ab2
 *
 * RU: Паттерн Мост
 *
 * Назначение: Разделяет один или несколько классов на две отдельные иерархии —
 * абстракцию и реализацию, позволяя изменять их независимо друг от друга.
 *
 *               A
 *            /     \                        A         N
 *          Aa      Ab        ===>        /     \     / \
 *         / \     /  \                 Aa(N) Ab(N)  1   2
 *       Aa1 Aa2  Ab1 Ab2
 */

/**
 * EN: The Abstraction defines the interface for the "control" part of the two
 * class hierarchies. It maintains a reference to an object of the
 * Implementation hierarchy and delegates all of the real work to this object.
 *
 * RU: Абстракция устанавливает интерфейс для «управляющей» части двух иерархий
 * классов. Она содержит ссылку на объект из иерархии Реализации и делегирует
 * ему всю настоящую работу.
 */

class Abstraction
{
    /**
     * @var Implementation
     */
    protected $implementation;

    public function __construct(Implementation $implementation)
    {
        $this->implementation = $implementation;
    }

    public function operation(): string
    {
        return "Абстракция: Базовая операция с:<br>" .
            $this->implementation->operationImplementation();
    }
}

/**
 * Можно расширить Абстракцию без изменения классов Реализации.
 */
class ExtendedAbstraction extends Abstraction
{
    public function operation(): string
    {
        return "РасширеннаяАбстракция: Расширенная операция с:<br>" .
            $this->implementation->operationImplementation();
    }
}

/**
 * Реализация устанавливает интерфейс для всех классов реализации.
 */
interface Implementation
{
    public function operationImplementation(): string;
}

/**
 * Каждая Конкретная Реализация соответствует определённой платформе.
 */
class ConcreteImplementationA implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationA: Результат работы на платформе А.<br>";
    }
}

class ConcreteImplementationB implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationB: Результат работы на платформе B.<br>";
    }
}

/**
 * Клиентский код работает только с классом Абстракции.
 */
function clientCode(Abstraction $abstraction)
{
    echo $abstraction->operation();
}

// Клиентский код может работать с любой комбинацией абстракции и реализации
$implementation = new ConcreteImplementationA();
$abstraction = new Abstraction($implementation);
clientCode($abstraction);

echo "<br>  ";

$implementation = new ConcreteImplementationB();
$abstraction = new ExtendedAbstraction($implementation);
clientCode($abstraction);