<?php

namespace RefactoringGuru\State\Conceptual;

/**
 * Паттерн Состояние
 *
 * Назначение: Позволяет объектам менять поведение в зависимости от своего
 * состояния. Извне создаётся впечатление, что изменился класс объекта.
 */
class Context
{
    /**
     * @var State Ссылка на текущее состояние Контекста.
     */
    private $state;

    public function __construct(State $state)
    {
        $this->transitionTo($state);
    }

    /**
     * Контекст позволяет изменять объект Состояния во время выполнения.
     */
    public function transitionTo(State $state): void
    {
        echo "Контекст: Переход в состояние " . get_class($state) . ".<br>";
        $this->state = $state;
        $this->state->setContext($this);
    }

    /**
     * Контекст делегирует часть своего поведения текущему объекту Состояния.
     */
    public function request1(): void
    {
        $this->state->handle1();
    }

    public function request2(): void
    {
        $this->state->handle2();
    }
}

/**
 * Базовый класс Состояния объявляет методы, которые должны реализовать все
 * Конкретные Состояния.
 */
abstract class State
{
    /**
     * @var Context
     */
    protected $context;

    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    abstract public function handle1(): void;
    abstract public function handle2(): void;
}

/**
 * Конкретные Состояния реализуют различные модели поведения.
 */
class ConcreteStateA extends State
{
    public function handle1(): void
    {
        echo "ConcreteStateA обрабатывает request1.<br>";
        echo "ConcreteStateA хочет изменить состояние контекста.<br>";
        $this->context->transitionTo(new ConcreteStateB());
    }

    public function handle2(): void
    {
        echo "ConcreteStateA обрабатывает request2.<br>";
    }
}

class ConcreteStateB extends State
{
    public function handle1(): void
    {
        echo "ConcreteStateB обрабатывает request1.<br>";
    }

    public function handle2(): void
    {
        echo "ConcreteStateB обрабатывает request2.<br>";
        echo "ConcreteStateB хочет изменить состояние контекста.<br>";
        $this->context->transitionTo(new ConcreteStateA());
    }
}

/**
 * Клиентский код.
 */
$context = new Context(new ConcreteStateA());
$context->request1();
$context->request2();